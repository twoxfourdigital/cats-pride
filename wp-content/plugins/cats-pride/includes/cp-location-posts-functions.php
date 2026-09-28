<?php

/**
 * Set Lat/Lon values for each shelter by using the Google Maps API
 */
function cp_update_shelter_lat_lon( $post_id = null )
{
    $logger = cp_get_logger();

    if( !defined('GOOGLE_API_MAPS_KEY' ) || empty( GOOGLE_API_MAPS_KEY ) ) {
        $logger->info( 'Google API maps key not set, unable to look-up lat/lon.' , [], 'general');
        return;
    }

    if ( $post_id == 0 ) {
        $post_id = null;
    }

    global $wpdb;

    $query = "SELECT p.ID as ID, p.post_title as post_title
              FROM {$wpdb->posts} p
              LEFT JOIN {$wpdb->postmeta} pm
                ON (p.ID = pm.post_id AND pm.meta_key = 'latitude')
              LEFT JOIN {$wpdb->postmeta} pm1
                ON (p.ID = pm1.post_id AND pm1.meta_key = 'longitude')
              WHERE (
              		(pm.post_id IS NULL OR pm.meta_value = '') 
              		OR 
              		(pm1.post_id IS NULL OR pm1.meta_value = '')
              	) 
              AND p.post_type = 'cp_shelter'";

    if ( $post_id !== null ) {
        $query .= ' AND p.ID = ' . (int) $post_id;
    }

    $posts = $wpdb->get_results( $query );

    if( $posts ) {

        $logger->info( 'Updating lat/long values for ' . count( $posts ) . ' shelter(s).' , array( 'result_count' => count( $posts ) ) , 'general');

        foreach ($posts as $post) {

            $address_1  = get_field( 'address_1', $post->ID );
            $address_2  = get_field( 'address_2', $post->ID );
            $city       = get_field( 'city', $post->ID );
            $state      = get_field( 'state', $post->ID );
            $zip_code   = get_field( 'zip_code', $post->ID );

            if(!$address_2) {
                $address_2 = '';
            }

            if (!empty($address_1) && !empty($city) && !empty($state) && !empty($zip_code)) {

                $address = $address_1 . ' ' . $address_2 . ' ' . $city . ', ' . $state . ' ' . $zip_code;
                $output  = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . urlencode( $address ) . '&sensor=false&key=' . GOOGLE_API_MAPS_KEY );

                if ($output) {

                    // Decode the JSON into an object
                    $geocode = json_decode($output);

                    // Exit out of the loop, we are at the limit for the day

                    if( !isset( $geocode->status ) ) {
                        continue;
                    }

                    // Stop lookups, we are out for today
                    if( $geocode->status === 'OVER_QUERY_LIMIT' ) {
                        $logger->info( 'Over query limit for looking up lat/lon.' , [], 'general');
                        break;
                    }

                    if ( $geocode->status !== 'OK' ) {
                        continue;
                    }

                    // Extract the lat/lon values
                    $latitude  = $geocode->results[0]->geometry->location->lat;
                    $longitude = $geocode->results[0]->geometry->location->lng;
                    $places_id = $geocode->results[0]->place_id;

                    // Save them on the post, into the ACF fields
                    if ( !empty( $latitude ) ) {
                        update_field('latitude', $latitude, $post->ID);
                    }
                    if ( !empty( $longitude ) ) {
                        update_field('longitude', $longitude, $post->ID);
                    }

                    if ( !empty( $places_id ) ) {
                        update_post_meta($post->ID, 'google_places_id', $places_id);
                    }

                    $logger->info(
                        'Shelter update lat/lon.',
                        array('lat' => $latitude, 'lon' => $longitude),
                        'shelter_account',
                        'cp_shelter',
                        $post->ID
                    );

                    // Sleep for 1/10 second
                    usleep( 100000 );

                }
            }
        }
    }
}

// Let's ensure all shelters have lat/lon set
/*
if( isset( $_REQUEST['SHELTER_SET_LAT_LON'] ) ) {
    add_action('init', 'cp_update_shelter_lat_lon', 10, 1);
}
*/

/**
 *
 * get_nearest_posts_by_lat_lon
 * @param float $lat ;
 * @param float $lon ;
 * @param float $radius ;
 * @param array $post_type;
 *
 * @return array
 *
 */
function cp_get_nearest_posts_by_lat_lon($lat, $lon, $post_type, $radius = 100)
{
    global $wpdb;

    $meta_key_latitude  = 'latitude';
    $meta_key_longitude = 'longitude';
    $post_status        = array( 'publish', 'draft' );
    $meta               = array( 'city', 'state', 'website' );
    $select_meta        = '';

    foreach($meta as $m) {
        $select_meta .= "MAX(CASE WHEN pm3.meta_key = '{$m}' THEN pm3.meta_value ELSE NULL END) as `{$m}`, ";
    }

    $query = "SELECT p.id as shelter_id,
                     p.post_title as `name`,
                     p.post_type,
                     p.post_status,
                     " . $select_meta . "
                     pm1.meta_value as `latitude`, 
                     pm2.meta_value as `longitude`,
                     TRUNCATE(SQRT(
                        POW(69.1 * (pm1.meta_value - %f), 2) +
                        POW(69.1 * (%f - pm2.meta_value) * COS(pm1.meta_value / 57.3), 2)
                     ), 2) AS distance
              FROM ".$wpdb->posts." p
              INNER JOIN ".$wpdb->postmeta." pm1
                ON (p.ID = pm1.post_id AND pm1.meta_key = '" . $meta_key_latitude . "' AND pm1.meta_value != '' AND pm1.meta_value IS NOT NULL)
              INNER JOIN ".$wpdb->postmeta." pm2
                ON (p.ID = pm2.post_id AND pm2.meta_key = '" . $meta_key_longitude . "' AND pm2.meta_value != '' AND pm2.meta_value IS NOT NULL)
              LEFT JOIN ".$wpdb->postmeta." pm3
				  	ON (p.id = pm3.post_id)
              WHERE p.post_status IN ('" . implode("', '", $post_status ). "') AND p.post_type = '" . $post_type . "'
              GROUP BY p.id 
              " . (($radius && is_numeric($radius) ? 'HAVING distance <= ' . '%f' : '')) . "
              ORDER BY distance";

    $params = array($lat, $lon);

    if ($radius && is_numeric($radius)) {
        $params[] = $radius;
    }

    $results = $wpdb->get_results($wpdb->prepare($query, $params));

    return apply_filters('cp_nearest_posts_' . $post_type . '_by_lat_lon_results', $results, $lat, $lon, $radius);

}

/**
 *
 * get_nearest_lat_lon_by_zip
 * @param string $zip ;
 *
 */
function cp_get_nearest_lat_lon_by_zip( $zip )
{
    global $wpdb;

    if (!empty( $zip )) {

        $query = "SELECT latitude, longitude
                      FROM {$wpdb->prefix}maxmind_location
                      WHERE postalCode = %s";

        $coords = $wpdb->get_row($wpdb->prepare($query, (int) $zip), ARRAY_A);

        if ($coords) {

            if (isset($coords['latitude']) && isset($coords['longitude'])
                && $coords['longitude'] && $coords['longitude']
            ) {

                return array('lat' => $coords['latitude'], 'lon' => $coords['longitude']);

            }
        }
    }

    return false;

}