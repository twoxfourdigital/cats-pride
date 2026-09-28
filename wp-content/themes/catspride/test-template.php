<?php

/**
 * Template Name: Test Template
 *
 * @package CatsPride
 */

get_header();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(1);

do_action('catspride_store_locator_form_start'); 
$items1 = cp_get_store_locator_products();
// echo '<pre>';
// var_dump(  cp_get_store_locator_products());
// echo '</pre>';
// $counter =1;
// foreach($items as $item_keys){
//     $item_key = cp_get_store_locator_product_key_from_id($item_keys);
//     echo $counter.'<br>'.$item_key.'<br>';
//     $counter++;
// }
?>
<br> <br> <br> <br> <br> <br> <br> 
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

    <form class="catspride-StoreLocatorForm edit-shelter" action="https://catspride.com/?page_id=17380" method="post">

    
<div class="x-container">
    <div class="x-column x-sm x-1-2">
    <select class="catspride-Input catspride-Input--select input-select" name="item_id" id="item_id" style="max-width: 100%">
                <?php foreach ($items1 as $item) {
                    if ($item['value'] === "Complete Care") { ?>
                        <option value="<?php echo $item['id']; ?>" <?php selected($item['id'], (isset($item_id)) ? $item_id : false) ?>><?php echo $item['value'] . " 18LB Bag" ?></option>
                    <?php } elseif ($item['value'] === "Pure & Fresh") { ?>
                        <option value="<?php echo $item['id']; ?>" <?php selected($item['id'], (isset($item_id)) ? $item_id : false) ?>><?php echo $item['value'] . " 18LB Bag" ?></option>
                    <?php } elseif ($item['value'] === "Max Power: Total Odor Control Scented") { ?>
                        <option value="<?php echo $item['id']; ?>" <?php selected($item['id'], (isset($item_id)) ? $item_id : false) ?>><?php echo $item['value'] . " 24LB Bag" ?></option>
                    <?php } elseif ($item['value'] === "Max Power: Total Odor Control Unscented") { ?>
                        <option value="<?php echo $item['id']; ?>" <?php selected($item['id'], (isset($item_id)) ? $item_id : false) ?>><?php echo $item['value'] . " 24LB Bag" ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $item['id']; ?>" <?php selected($item['id'], (isset($item_id)) ? $item_id : false) ?>><?php echo $item['value'] ?></option>
                <?php }
                } ?>
            </select>
                    </div>
                    <div class="x-column x-sm x-1-4">
                        <input type="text" class="catspride-Input catspride-Input--text input-text" required="" name="zip_code" id="zip_code" placeholder="Enter Zip Code..." value="" style="height: 37px;margin-left: 20px;">
                    <div data-lastpass-icon-root="" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
                    <div class="x-column x-sm x-1-4">
                        <input type="submit" class="catspride-Button button" name="store_locator" value="Search">
                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="ee363526bd"><input type="hidden" name="_wp_http_referer" value="/store-locator/">            <input type="hidden" name="action" value="store_locator">
                    </div>
                </div>


                <hr>
                <div class="x-container">

                    
                </div>


                </form>

		<?php 

$items = cp_get_valid_store_locator_product_ids();

        var_dump($items);
        
        if ( !isset( $_POST['zip_code'] ) || empty( $_POST['zip_code'] ) || !preg_match( '/^[0-9]{5}([- ]?[0-9]{4})?$/', $_POST['zip_code'] ) ) {
            wc_add_notice( 'Please enter your zip code and try again.', 'error' );
            return;
        }

       

        if ( !isset( $_POST['item_id'] ) || empty( $_POST['item_id'] ) || !in_array( $_POST['item_id'], $items) ) {
            wc_add_notice( 'Please select a product and try again.', 'error' );
            return;
        }

        $item_key = cp_get_store_locator_product_key_from_id( $_POST['item_id'] );
       echo 'hey'; var_dump($item_key);
        $stores = array();

        $user_ip_address = $_SERVER['REMOTE_ADDR'];
        $search_zip_code = $_POST['zip_code'];

        // Set the following parameters to send to Astute for store lookup
        $params = array(
            'item' => $item_key,
            'ip' => $user_ip_address,
            'zip' => $search_zip_code,
            'customer' => 'oildri',
            'radius' => 400
        );

        // Format the options into the correct submission format
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Referer: ". get_bloginfo('url') . "/storelocator/\r\n" .
                    "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query( $params )
            )
        );

        // URL to send request to
        $url = 'http://www2.itemlocator.net/ils/locatorJSON/';

        $fp = file_get_contents($url, false, stream_context_create( $opts ));

        $GLOBALS['cp_sl_xml_response'] = $fp;

        if ($fp) //Make sure we got a response
        {

            var_dump($fp);
            $json = json_decode( $fp ); //Parse JSON

            if ($json && count( $json->nearbyStores ) > 0) //Check if we got any stores returned
            {
                $stores = array();
                foreach ( $json->nearbyStores as $store )
                {
                    $stores[$store->storeid] = array(
                        "store_id"   => (string) $store->storeid,
                        "distance"   => (string) $store->distance,
                        "name"       => (string) $store->name,
                        "phone"      => (string) $store->phone,
                        "address"    => (string) $store->address,
                        "address2"   => (string) $store->address2,
                        "city"       => (string) $store->city,
                        "state"      => (string) $store->state,
                        "zip"        => (string) $store->zip,
                        "latitude"   => (string) $store->latitude,
                        "longitude"  => (string) $store->longitude
                    );
                }

                //Sort the stores by distance
                foreach ($stores as $id => $store)
                {
                    $distances[$id] = $store['distance'];
                }
                array_multisort($distances, SORT_ASC, $stores);

            } else {

                wc_add_notice( 'No stores were found near you. To purchase online instead, please see below.', 'notice' );
                return;

            }

        } else {

            wc_add_notice( 'We are having a problem retrieving your nearest store. Please try again later.', 'error' );
            return;

        }

        $GLOBALS['cp_sl_stores'] = $stores;
        
        ?>



	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>