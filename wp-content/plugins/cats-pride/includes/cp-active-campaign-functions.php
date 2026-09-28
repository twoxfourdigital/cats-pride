<?php

/**
 * @param $user_id
 * @return bool|mixed
 */
function cp_user_exists_in_active_campaign_by_email( $email )
{
    require_once( dirname( __FILE__ ) . "/vendor/activecampaign/includes/ActiveCampaign.class.php");

    if ( defined( 'ACTIVECAMPAIGN_URL' ) && defined( 'ACTIVECAMPAIGN_API_KEY' ) ) {

        $ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);
        $ac->set_curl_timeout(10);
        $user = $ac->api('contact/view?email=' . $email);

        return $user;
    }

    return false;

}

/**
 * @param $user_id
 * @return bool|mixed
 */
function cp_add_user_to_active_campaign( $user_id )
{
    cp_sync_active_campaign_data( $user_id );
}

/**
 * @param $user_id
 * @param $tag
 * @return bool|mixed
 */
function cp_remove_tag_from_active_campaign_contact( $user_id, $tag )
{

    /**
     * @var $logger CP_Logger
     */
    $logger = cp_get_logger();

    if ( defined( 'ACTIVECAMPAIGN_URL' ) && defined( 'ACTIVECAMPAIGN_API_KEY' ) ) {

        require_once( dirname( __FILE__ ) . "/vendor/activecampaign/includes/ActiveCampaign.class.php");

        $ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);
        $ac->set_curl_timeout(10);

        $user   = get_user_by('ID', $user_id);
        $fields = array(
            'email' => $user->user_email,
            'tags' => $tag
        );

        $logger->info(
            'Updating Active Campaign tags on user account.',
            array(
                'fields' => $fields,
                'user_id' => $user_id
            ),
            'user_account',
            'user',
            $user_id
        );

        $result = $ac->api('contact/tag_remove', $fields);

        return $result;

    } else {

        $logger->error(
            'Unable to sync to Active Campaign, credentials are not set.',
            [],
            'active_campaign'
        );

        return false;

    }
}

/**
 * @param $user_id
 * @param $fields
 * @return bool|mixed
 */
function cp_sync_active_campaign_contact( $user_id = null, $fields = null )
{
    if ( defined( 'ACTIVECAMPAIGN_URL' ) && defined( 'ACTIVECAMPAIGN_API_KEY' )
        && (
            ( $user_id !== NULL && is_numeric( $user_id ) )
            || ( isset( $fields['email'] ) && !empty( $fields['email'] ) )
        )) {

        require_once( dirname( __FILE__ ) . "/vendor/activecampaign/includes/ActiveCampaign.class.php");

        $ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);
        $ac->set_curl_timeout(10);

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();

        if ( $user_id !== NULL ) {

            $user   = get_user_by('ID', $user_id);
            $fields = array_merge( array( 'email' => $user->user_email ), $fields );

            $logger->info(
                'Updating Active Campaign account for user.',
                array( 'fields' => $fields ),
                'user_account',
                'user',
                $user_id
            );

        }

        if ( defined( 'ACTIVE_CAMPAIGN_DEBUG' ) && ACTIVE_CAMPAIGN_DEBUG === true ) {

            $logger->debug(
                'Sending info to Active Campaign.',
                array( 'fields' => $fields ),
                'active_campaign'
            );

        }

        $contact_sync = $ac->api('contact/sync', $fields);

        if ( defined( 'ACTIVE_CAMPAIGN_DEBUG' ) && ACTIVE_CAMPAIGN_DEBUG === true ) {

            $logger->debug(
                'Result from Active Campaign.',
                array( 'contact' => $contact_sync ),
                'active_campaign'
            );
        }

        if (!(int)$contact_sync->success) {

            $logger->error(
                "Syncing contact failed for user: {$fields['email']}. Error returned: " . $contact_sync->error,
                array( 'fields' => $fields ),
                'active_campaign'
            );

        } else {

            if( $user_id !== NULL ) {
                // Save the user's Active Campaign subscriber ID
                update_user_meta( $user_id, '_active_campaign_sub_id', (int) $contact_sync->subscriber_id );
            }

        }

        return $contact_sync;

    } else {

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();

        $logger->error(
            'Unable to sync to Active Campaign, credentials are not set.',
            array( 'fields' => $fields ),
            'active_campaign'
        );

        return false;

    }
}

/**
 * @param int|string $user_id_or_email
 * @param null $list
 * @return bool|mixed
 */
function cp_unsubscribe_active_campaign_contact( $user_id_or_email, $list = null )
{
    // If a list is not passed, default to the main one
    if ($list === NULL) {
        $list = ACTIVECAMPAIGN_LIST_ID;
    }

    // Set status of list subscription to un-subscribed
    $fields = ["p[" . $list . "]" => $list];
    $fields["status[" . $list . "]"] = 2;

    // If a user_id is not passed, assume it is an email and set it as such
    if ( !is_numeric( $user_id_or_email ) ) {
        $fields['email'] = $user_id_or_email;
        $user_id_or_email = null;
    } else {
        // If the user is a shelter manager, let's ensure that they are not subscribed to the pending shelter list anymore either
        $user = new WP_User( $user_id_or_email );
        if ( in_array( 'shelter_manager', $user->roles ) && defined( 'ACTIVECAMPAIGN_SHELTER_LIST_ID' ) ) {
            $fields["p[" . ACTIVECAMPAIGN_SHELTER_LIST_ID . "]"] = ACTIVECAMPAIGN_SHELTER_LIST_ID;
            $fields["status[" . ACTIVECAMPAIGN_SHELTER_LIST_ID . "]"] = 2;
        }
    }

    return cp_sync_active_campaign_contact( $user_id_or_email,  $fields);
}

add_action( 'delete_user', function( $user_id ) {
    cp_unsubscribe_active_campaign_contact( $user_id );
});

/**
 * cp_sync_active_campaign_data
 *
 * @param $user_id null|int
 * @return bool|mixed
 */
function cp_sync_active_campaign_data( $user_id = null, $limit = null )
{
    global $wpdb;

    $logger = cp_get_logger();

    $fields = array();
    $limit  = ( $limit !== null && is_numeric( $limit ) ) ? (int) $limit : 50;

    $query = "SELECT
                u.ID           as user_id,
                u.user_email   as email,
                um8.meta_value as first_name,
                um9.meta_value as last_name,
                um1.meta_value as manage_shelter_id,
                um2.meta_value as marketing_opt_in,
                um3.meta_value as birthdate,
                um4.meta_value as pet_information,
                um5.meta_value as gender,
                um6.meta_value as product_choice,
                um7.meta_value as purchase_outlet,
                p.post_title   as shelter_name,
                pm1.meta_value as shelter_profile_completed,
                pm2.meta_value as shelter_token,
                pm3.meta_value as shelter_page_saved
              FROM {$wpdb->users} u 
              LEFT JOIN {$wpdb->usermeta} um1 ON (um1.meta_key = '_cp_manage_shelter_id' AND um1.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um2 ON (um2.meta_key = '_cp_marketing_opted_in' AND um2.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um3 ON (um3.meta_key = 'birthdate' AND um3.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um4 ON (um4.meta_key = 'pet_information' AND um4.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um5 ON (um5.meta_key = 'gender' AND um5.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um6 ON (um6.meta_key = 'preferred_litter_type' AND um6.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um7 ON (um7.meta_key = 'preferred_purchase_outlet' AND um7.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um8 ON (um8.meta_key = 'first_name' AND um8.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um9 ON (um9.meta_key = 'last_name' AND um9.user_id = u.ID)
              LEFT JOIN {$wpdb->usermeta} um10 ON (um10.meta_key = '_cp_last_active_campaign_sync_date' AND um10.user_id = u.ID)
              LEFT JOIN {$wpdb->postmeta} pm1 ON (pm1.meta_key = '_cp_shelter_profile_completed' AND pm1.post_id = um1.meta_value)
              LEFT JOIN {$wpdb->postmeta} pm2 ON (pm2.meta_key = '_cp_shelter_token' AND pm2.post_id = um1.meta_value)
              LEFT JOIN {$wpdb->postmeta} pm3 ON (pm3.meta_key = '_cp_shelter_page_saved' AND pm3.post_id = um1.meta_value)
              LEFT JOIN {$wpdb->posts} p ON (p.ID = um1.meta_value)
              WHERE u.user_email != ''";

    if ( !empty( $user_id ) && $user_id !== null && is_numeric( $user_id ) ) {
        $query .= ' AND u.ID = ' . (int) $user_id;
    } else {
        // Only update users that have not synced their account in the past 7 days
        $query .= ' AND (um10.meta_value IS NULL OR um10.meta_value < "' . date( 'Y-m-d',strtotime('-7 days' ) ) . '")';
        // Add a limit to only send X at once to Active Campaign as well.
        $query .= ' LIMIT ' . $limit;
    }

    $results = $wpdb->get_results( $query );

    if ( $results && count( $results ) > 0 ) {

        if ( count( $results ) > 1 ) {

            /*
             * If we are performing more than a single update, we want to ensure this is being done on production
             */
            if ( !defined('APP_ENV') || !in_array( strtolower( APP_ENV ), [ 'prod', 'production' ] ) ) {
                return false;
            }

            /*
             * Retrieve the user_ids that are being updated as part of this batch
             */
            $user_ids = array_map( function( $values ) { return $values->user_id; }, $results );
            $logger->info( 'Running ' . __FUNCTION__, [ 'total_users_to_sync' => count( $results ), 'user_ids' => $user_ids ], 'general' );

        }

        foreach ($results as $user) {

            $fields['first_name'] = $user->first_name;
            $fields['last_name']  = $user->last_name;
            $fields['email']      = $user->email;

            // If they have accepted marketing emails, ensure that they are subscribed.
            $allow_marketing = (!empty($user->marketing_opt_in) && $user->marketing_opt_in === '1') ? true : false;

            // Check to see if they are a shelter manager
            $is_shelter_manager = (!empty($user->manage_shelter_id) && is_numeric($user->manage_shelter_id)) ? true : false;
            $user_type          = ($is_shelter_manager) ? 'Shelter' : 'Member';

            $fields['tags'] = $user_type;

            /*
             * Campaigns
             */
            $fields[ "p[" . ACTIVECAMPAIGN_LIST_ID . "]" ] = ACTIVECAMPAIGN_LIST_ID;

            // 1 = Active, 2 = Un-subscribed
            $fields[ "status[" . ACTIVECAMPAIGN_LIST_ID . "]" ] = ($allow_marketing === true) ? 1 : 2;

            // If the user is opted in to marketing or not, set the value
            $fields['field']['%OPTEDIN%,0'] = ($allow_marketing === true) ? 1 : 0;

            /*
             * Is Shelter Manager
             */
            if ($is_shelter_manager === true) {

                /*
                 * Set the time that the shelter profile was completed
                 */
                if (!empty($user->shelter_profile_completed)) {
                    $fields['field']['%SHELTER_PROFILE_COMPLETED%,0'] = (!empty($user->shelter_profile_completed)) ? $user->shelter_profile_completed : null;
                }

                if (!empty($user->shelter_profile_completed)) {
                    $fields['field']['%SHELTER_NAME%,0'] = ( !empty( $user->shelter_name ) ) ? $user->shelter_name : null;
                }

                if (!empty($user->shelter_page_saved)) {
                    $fields['field']['%SHELTER_PAGE_SAVED%,0'] = ( !empty( $user->shelter_page_saved ) ) ? $user->shelter_page_saved : null;
                }

                if (!empty($user->shelter_token)) {

                    $purl = add_query_arg([
                        'cp_st' => $user->shelter_token,
                        'tab'   => 'register'
                    ], wc_get_page_permalink('myaccount'));

                    if (!empty($purl)) {
                        $fields['field']['%PURL%,0'] = $purl;
                    }

                }

            } else {

                if ( !empty( $user->birthdate ) ) {
                    $fields['field']['%BIRTHDAY%,0'] = $user->birthdate;
                }

                if ( !empty( $user->gender ) && in_array( $user->gender, ['Male', 'Female'] ) ) {
                    $sex = ( $user->gender === 'Male') ? 'Cat Loving Male' : 'Cat Loving Female';
                    $fields['field']['%SEX%,0'] = $sex;
                }
                if ( !empty( $user->product_choice ) ) {
                    $fields['field']['%YOUR_CATS_PRIDE_PRODUCT_OF_CHOICE%,0'] = $user->product_choice;
                }
                if ( !empty( $user->purchase_outlet ) ) {
                    $fields['field']['%PREFERRED_PURCHASE_OUTLET%,0'] = $user->purchase_outlet;
                }

                if ( !empty( $user->pet_information ) ) {
                    $user->pet_information = maybe_unserialize( $user->pet_information );
                }

                if ( is_array( $user->pet_information ) && count( $user->pet_information ) > 0) {

                    $count = 1;

                    foreach ( $user->pet_information as $cat ) {

                        $name = (isset($cat['name'])) ? $cat['name'] : '';
                        $date = (isset($cat['date'])) ? $cat['date'] : '';

                        $fields['field'][ '%CAT_' . $count . '_NAME%,0' ]                 = $name;
                        $fields['field'][ '%CAT_' . $count . '_BIRTHDAYADOPTION_DAY%,0' ] = $date;
                        $count++;

                    }

                }

                $fields['field']['%NUMBER_OF_CATS_IN_HOUSEHOLD%,0'] = ( !empty( $user->pet_information ) ) ? count( $user->pet_information ) : 0;
                $fields['field']['%NUMBER_OF_CATS%,0']              = ( !empty( $user->pet_information ) ) ? count( $user->pet_information ) : 0;

            }

            // This will help us to limit the frequency in which updates in bulk are performed
            update_user_meta( $user->user_id, '_cp_last_active_campaign_sync_date', date('Y-m-d') );

            // Save the details of the contact
            // Active Campaign has a rate limit of 5 requests per second.
            cp_sync_active_campaign_contact( $user->user_id, $fields );

            if ( count( $results ) > 1 ) {
                usleep(2.5 * 1000 ); // .25 seconds
            }

        }

        return true;

    }

    return false;

}

/**
 * @param $user
 */
function cp_show_active_campaign_profile_fields( $user ) {
    ?>

    <table class="form-table">
        <tr>
            <th><label for="active_campaign_sync"><?php esc_html_e( 'Sync to Active Campaign', 'catspride' ); ?></label></th>
            <td><a href="<?php echo add_query_arg( 'active_campaign_sync', $user->ID, get_edit_user_link( $user->ID ) ); ?>" class="button button-secondary">Sync User</a></td>
        </tr>
    </table>
    <?php
}

/**
 * Send the user over to active campaign with it's current data points
 */
function cp_submit_sync_active_campaign_user() {
    // This will trigger a single sync event to active campaign for a user, triggered by a button click
    if ( is_admin() && isset( $_GET['active_campaign_sync'] ) && current_user_can( 'manage_options' ) ) {
        cp_sync_active_campaign_data( $_GET[ 'active_campaign_sync' ] );
    }
    // This will trigger a bulk sync event to active campaign
    if( isset( $_REQUEST['ACTIVE_CAMPAIGN_SYNC_USERS'] ) && is_admin() && current_user_can( 'manage_options' ) ) {
        cp_sync_active_campaign_data( null, ( isset( $_REQUEST['LIMIT'] ) ) ? (int) $_REQUEST['LIMIT'] : null );
    }
}

add_action( 'wp_loaded', 'cp_submit_sync_active_campaign_user' );
add_action( 'show_user_profile', 'cp_show_active_campaign_profile_fields' );
add_action( 'edit_user_profile', 'cp_show_active_campaign_profile_fields' );