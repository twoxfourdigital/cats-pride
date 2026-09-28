<?php

/**
 * Cat's Pride Shelter Functions
 *
 * Functions for shelter specific tasks.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @param $user_id
 * @return bool
 */
function cp_is_shelter_manager( $user_id ) {
    return ( cp_get_shelter_by_manager_id( $user_id ) !== false ) ? true : false;
}

/**
 * Lookup the shelter assigned to a manager.
 *
 * @param $user_id
 * @return bool|int|WP_Post
 */
function cp_get_shelter_by_manager_id( $user_id, $return_as_post = false )
{
    $shelter_id = get_user_meta($user_id, '_cp_manage_shelter_id', true);

    if ( $return_as_post === true && $shelter_id ) {
        $shelter = get_post( $shelter_id );
        return ( $shelter instanceof WP_Post ) ? $shelter : false;
    }

    return $shelter_id ? (int) $shelter_id : false;
}

/**
 *
 * This function is used to retire all nominations currently active. It will set all nominations to end on the current
 * date and time. All users will have to nominate a shelter again.
 *
 * @param null $shelter_id
 */
function cp_reset_shelter_nominations( $shelter_id = null )
{
    global $wpdb;

    $logger = cp_get_logger();

    $query  = "UPDATE {$wpdb->prefix}cp_nominations SET active_end = NOW() WHERE active_end IS NULL";
    $values = [];

    if ( $shelter_id !== null && is_numeric( $shelter_id ) ) {
        $query .= " AND shelter_post_id = %d";
        $values[] = $shelter_id;
    }

    $wpdb->query( $wpdb->prepare( $query, $values) );

    $logger->info(
        'Shelter nominations reset for ' . ( ( $shelter_id !== null && is_numeric( $shelter_id ) ) ? $shelter_id : ' all shelters' ),
         [],
        ( $shelter_id !== null && is_numeric( $shelter_id ) ) ? 'shelter_account' : 'general',
        ( $shelter_id !== null && is_numeric( $shelter_id ) ) ? 'cp_shelter' : null,
        ( $shelter_id !== null && is_numeric( $shelter_id ) ) ? $shelter_id : null
    );

    // Refresh the _cp_nomination_total post meta entries
    cp_refresh_shelter_nomination_count();

}

/**
 * Lookup the manager assigned for a shelter by shelter/post id.
 *
 * @param $post_id
 * @return bool|int
 */
function cp_get_shelter_manager_id( $post_id )
{
    $user_id = reset(get_users(
        [
            'meta_key'    => '_cp_manage_shelter_id',
            'meta_value'  => $post_id,
            'number'      => 1,
            'count_total' => false,
            'fields'      => 'ids'
        ])
    );

    return $user_id ? (int)$user_id : false;
}

/**
 * @param $shelter_id
 * @return array|bool|null|WP_Post
 */
function cp_get_shelter_by_id($shelter_id)
{
    $post = get_post( $shelter_id );

    if ($post && $post->post_type === 'cp_shelter') {
        return $post;
    }

    return false;

}

/**
 *
 * If a token is already set for the shelter, it won't add a new one. This will ensure that we don't accidentally
 * remove a previously distributed token if this function were to be called somehow outside of the norm.
 *
 * @param $post_id
 * @return string
 */
function cp_set_token_for_shelter($post_id)
{
    if (is_numeric($post_id)) {
        $token = md5(uniqid(null, true));
        add_post_meta($post_id, '_cp_shelter_token', $token, true);

        return $token;
    } else {
        return false;
    }
}

/**
 * Find a shelter that is assign the provided token and return it's ID
 *
 * @param $token
 * @return null|string
 */
function cp_get_shelter_by_token($token)
{

    global $wpdb;

    $query = "SELECT post_id as shelter_id 
              FROM {$wpdb->postmeta} 
              WHERE meta_key = '_cp_shelter_token' AND meta_value = %s";

    $result = $wpdb->get_var($wpdb->prepare($query, [$token]));

    return ($result !== null) ? (int)$result : false;

}

/**
 * Return the total number of nominations for a single shelter or for all of them.
 *
 * @param null $post_id
 * @param bool $active
 * @return int
 */
function cp_get_shelter_nomination_count( $post_id = null, $active = true )
{

    global $wpdb;

    $transient_name = 'cp_nomination_total';

    if ($post_id !== null) {
        $transient_name .= '_' . $post_id . '_' . $active;
    } else {
        $transient_name .= '_' . $active;
    }

    $transient = get_transient($transient_name);

    if ($transient) {

        return $transient;

    } else {

        // If we are only counting the active nominations, let's be sure to factor in the bonus multiples
        if ($active === true) {
            $select = 'SUM(COALESCE(bonus_multiple, 1))';
        } else {
        // If we are counting all nominations (users that have submitted a nomination), we will ignore the multiples
            $select = 'COUNT( DISTINCT user_id )';
        }

        $query = "SELECT $select FROM {$wpdb->prefix}cp_nominations WHERE 1";

        if ($post_id !== null && is_numeric($post_id)) {
            $query .= ' AND shelter_post_id = ' . (int)$post_id;
        }

        if ($active === true) {
            $query .= ' AND active_end IS NULL';
        }

        $result = $wpdb->get_var( $query );
        $result = ($result && $result > 0) ? (int)$result : 0;

        set_transient($transient_name, $result, 60 * 60 * 24);

        return $result;

    }

}

/**
 * @param null $post_id
 * @return int
 */
function cp_refresh_shelter_nomination_count()
{

    global $wpdb;

    /*
     * Delete all shelter meta entries for the nomination totals
     */
    $wpdb->query("DELETE FROM wp_postmeta WHERE meta_key = '_cp_nomination_total';");

    /*
     * Insert new nomination counts for all shelters that have nominations, taking into account
     * their bonus multipliers from certain users.
     */
    $wpdb->query("INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value)
    SELECT shelter_post_id, '_cp_nomination_total', SUM(COALESCE(bonus_multiple, 1))
    FROM {$wpdb->prefix}cp_nominations n
    WHERE n.active_end IS NULL
    GROUP BY shelter_post_id;");

    /*
     * If a shelter does not have a nomination, we want to still have a total count assigned to their
     * shelter, so we will insert records for them with a count of 0.
     */
    $wpdb->query("INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value)
    SELECT p.ID, '_cp_nomination_total', 0
    FROM {$wpdb->posts} p
    LEFT JOIN {$wpdb->postmeta} pm
      ON (p.ID = pm.post_id AND pm.meta_key = '_cp_nomination_total')
    WHERE p.post_type = 'cp_shelter' AND pm.post_id IS NULL;");

    $wpdb->query("DELETE FROM wp_options WHERE option_name LIKE '_transient_cp_nomination_total%';");

}

/**
 * @param $post_id
 * @return bool|mixed
 */
function cp_get_token_by_shelter_id($post_id)
{
    $shelter_token = get_post_meta($post_id, '_cp_shelter_token', true);

    return $shelter_token ? $shelter_token : false;
}

/**
 * Generate a token for each shelter and save it as a post meta entry.
 * This should only be used once and never again, but we'll keep it for posterity.
 */
function cp_set_token_for_shelters()
{
    $shelters = get_posts([
        'post_type'      => 'cp_shelter',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'     => '_cp_shelter_token',
                'compare' => 'NOT EXISTS'
            ]
        ]
    ]);

    if ($shelters) {
        foreach ($shelters as $shelter) {
            cp_set_token_for_shelter($shelter->ID);
        }
    }
}

/**
 * Running this function will retrieve all usermeta assignments for nominated shelters or for shelter managers
 * where the shelter has been trashed.
 */
function cp_clear_bad_shelter_assignments( $shelter_id = null )
{
    global $wpdb;

    // Clear out any user shelter manager assignments for shelters that are no longer available for nomination
    $query = "DELETE um
              FROM {$wpdb->usermeta} um
              LEFT JOIN {$wpdb->posts} p
                ON (um.meta_key = '_cp_manage_shelter_id' 
                  AND um.meta_value = p.ID 
                  AND (p.post_status = 'publish' || p.post_status = 'pending' || p.post_status = 'draft')
                  AND p.post_type = 'cp_shelter'
              )
              WHERE um.meta_key = '_cp_manage_shelter_id' AND p.ID IS NULL";

    if ( $shelter_id !== null && is_numeric( $shelter_id ) ) {
        $query .= ' AND um.meta_value = ' . (int) $shelter_id;
    }
    $wpdb->query($query);


    // Clear out any user nominations for shelters that are no longer available for nomination
    $query = "UPDATE {$wpdb->prefix}cp_nominations n
              LEFT JOIN {$wpdb->posts} p
                ON (n.shelter_post_id = p.ID 
                  AND (p.post_status = 'publish' || p.post_status = 'pending' || p.post_status = 'draft')
                  AND p.post_type = 'cp_shelter'
              )
              SET n.active_end = NOW() 
              WHERE p.ID IS NULL";

    if ($shelter_id !== null && is_numeric( $shelter_id ) ) {
        $query .= ' AND n.shelter_post_id = ' . (int) $shelter_id;
    }
    $wpdb->query($query);

    cp_refresh_shelter_nomination_count();

}

/**
 * @param $check_bonus_code
 * @return array|bool
 */
function cp_get_bonus_code($check_bonus_code)
{
    $bonus_code = false;

    if (have_rows('shelter_bonus_codes', 'option')):

        while (have_rows('shelter_bonus_codes', 'option')) : the_row();

            $code = get_sub_field('bonus_code');

            if ($check_bonus_code !== $code)
                continue;

            $multiple   = get_sub_field('multiple');
            $expiration = get_sub_field('expiration_date');

            return [
                'bonus_code'      => $code,
                'multiple'        => $multiple,
                'expiration_date' => $expiration
            ];

        endwhile;

    endif;

    return $bonus_code;

}

/**
 * Assign a token to the shelter to be used by the email sent out to them for registration request after
 * the post is created.
 *
 * @param $post_id
 * @param $post
 * @param $update
 */
function cp_after_shelter_insert($post_id, $post, $update)
{
    if ($post->post_type !== 'cp_shelter' || wp_is_post_revision($post_id) || $update === true)
        return;

    cp_set_token_for_shelter($post_id);
}

add_action('wp_insert_post', 'cp_after_shelter_insert', 10, 3);

/**
 * When a shelter is moved to the trash, we want to un-assign any nominations and shelter manager assignments
 * that are tied to user accounts.
 */
function cp_on_shelter_trashed($ID)
{
    $post = get_post($ID);

    if ($post && $post->post_status === 'trash' && $post->post_type === 'cp_shelter') {

        // Remove any nominations and shelter manager associations with this shelter
        cp_clear_bad_shelter_assignments($ID);

        $shelter_email = get_post_meta($ID, 'email', true);

        $unsubscribe = true;

        if (!empty($shelter_email)) {

            // Ensure that they are un-subscribed from the shelter list if the email is no longer associated with
            // managing a shelter. Duplicate shelters are trashed, so this could cause an issue if a user is managing
            // another shelter, but a duplicate is trashed.
            $user = get_user_by('email', trim($shelter_email));

            if ($user && isset($user->roles) && is_array($user->roles) && in_array('shelter_manager', $user->roles)) {

                $manage_shelter_id = get_user_meta($user->ID, '_cp_manage_shelter_id', true);

                if (!empty($manage_shelter_id)) {

                    $unsubscribe = false;

                }

            }

            if ($unsubscribe === true) {
                cp_unsubscribe_active_campaign_contact( $shelter_email, ACTIVECAMPAIGN_SHELTER_LIST_ID );
            }

        }

    }

}

add_action('trashed_post', 'cp_on_shelter_trashed');

/**
 * Don't automatically empty the trash after x days (default 30 days) We don't want our trashed
 * shelters to be disappearing on us as we use those to reference when processing a nomination of a shelter
 * from a user. If they were submitted previously and opted out, we let the user know during nomination.
 */
function cp_remove_schedule_delete()
{
    remove_action('wp_scheduled_delete', 'wp_scheduled_delete');
}

add_action('init', 'cp_remove_schedule_delete');

/**
 *  Add a new email that will be sent out when a shelter is ready to be notified of their nomination/creation
 *  Add a new email that will be sent out when a shelter chooses to opt-out of the LFG program
 *  Add a new email that will be sent to users with a shelter they nominated has a status change
 *  Add a new email that will be sent to a friend through the friend share ability
 *  Add a new email that will be sent to the user that is sharing with a friend
 *  Add a new email that will be sent to the user that needs to confirm shipping details for a litter donation
 *  Add a new email that will be sent to the user that needs to confirm shipping details for a litter donation coupon
 *
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function cp_add_custom_shelter_woocommerce_emails($email_classes)
{
    $email_classes['CP_Register_Shelter_Invite_Email']                         = include('emails/class-cp-register-shelter-invite-email.php');
    $email_classes['CP_Optout_Shelter_Confirmation_Email']                     = include('emails/class-cp-optout-shelter-confirmation-email.php');
    $email_classes['CP_Shelter_Nomination_Status_Update_Email']                = include('emails/class-cp-shelter-nomination-status-update-email.php');
    $email_classes['CP_Litter_For_Good_Friend_Share_Email']                    = include('emails/class-cp-litter-for-good-friend-share-email.php');
    $email_classes['CP_Litter_For_Good_Congratulations_Email']                 = include('emails/class-cp-litter-for-good-congratulations-email.php');
    $email_classes['CP_Litter_For_Good_Friend_Share_Thank_You_Email']          = include('emails/class-cp-litter-for-good-friend-share-thank-you-email.php');
    $email_classes['CP_Transfer_Shelter_Request_Email']                        = include('emails/class-cp-transfer-shelter-request-email.php');
    $email_classes['CP_Transfer_Shelter_Status_Update_Email']                  = include('emails/class-cp-transfer-shelter-status-update-email.php');
    $email_classes['CP_Litter_Donation_Confirm_Shipping_Details_Email']        = include('emails/class-cp-litter-donation-confirm-shipping-details-email.php');
    $email_classes['CP_Litter_Donation_Confirm_Shipping_Details_Coupon_Email'] = include('emails/class-cp-litter-donation-confirm-shipping-details-coupon-email.php');

    return $email_classes;

}

add_filter('woocommerce_email_classes', 'cp_add_custom_shelter_woocommerce_emails');

/**
 * Send out the shelter invitation email, if send_notifications is passed.
 *
 * @param $post_id
 * @param $post
 * @param $update
 */
function cp_trigger_register_shelter_email($post_id, $post, $update)
{
    /*
     * If they clicked the Mark Approved button, let's ensure it is set as a draft - ready for manager sign-up.
     */
    if (isset($_POST['save_shelter_as_draft']) && $post->post_status !== 'draft') {

        wp_update_post(
            [
                'ID'          => $post_id,
                'post_status' => 'draft'
            ]
        );
        // Ensure we have a post object with the updated status
        $post = get_post( $post_id );
    }

    // Ensure that lat/lon are set on the shelter if address info is set
    cp_update_shelter_lat_lon( $post_id );

    /*
     * Ensure that the post is:
     * - a cp_shelter post type
     * - it must be an update to an existing post, not a new insert
     * - isn't a revision (auto-save)
     * - is in `draft` status
     * - hasn't been sent the invite before
     * - has a contact email address set
     * - doesn't already have a shelter manager set (3rd party driven shelter registrations set them on register)
     */
    if ( $post->post_type !== 'cp_shelter'
        || wp_is_post_revision( $post_id )
        || $update === false
        || $post->post_status !== 'draft'
        || !(get_post_meta( $post_id, '_cp_invite_email_sent', true ) === '' || isset( $_POST['force_send_shelter_invite'] ) )
        || get_post_meta( $post_id, 'email', true ) === ''
        || cp_get_shelter_manager_id( $post_id ) !== false )
        return;

    if ($post) {

        // Remove existing _cp_invite_email_sent meta entry and re-send email
        if (isset($_POST['force_send_shelter_invite'])) {
            delete_post_meta($post_id, '_cp_invite_email_sent');
        }

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();

        if ( !isset( $_POST['send_notifications'] ) ) {

            $logger->info(
                'Email invitation was blocked from sending to the shelter email.',
                ['params' => $_POST],
                'shelter_account',
                'cp_shelter',
                $post_id
            );

        } else {

            $logger->info(
                'Sending email invitation to shelter email.',
                ['params' => $_POST],
                'shelter_account',
                'cp_shelter',
                $post_id
            );

            // Instantiate the email classes so they are ready to send
            $mailer = WC()->mailer();
            $emails = $mailer->get_emails();

            if (isset($emails['CP_Register_Shelter_Invite_Email'])) {

                $emails['CP_Register_Shelter_Invite_Email']->trigger($post_id, $post, $update);

            }
        }

    }

}

add_action('wp_insert_post', 'cp_trigger_register_shelter_email', 10, 3);


/**
 *
 * Send out a notification to the user that nominated the shelter.
 * Re-assign shelter nominations if the shelter is being rejected due to being a duplicate.
 *
 * @param $shelter_post_id
 * @param $post
 * @param $update
 */
function cp_handle_shelter_status_change($shelter_post_id, $shelter, $update)
{
    if ($shelter->post_type === 'cp_shelter') {

        // Ensure we have the latest post object
        $shelter = get_post( $shelter_post_id );

        /*
         * If the shelter is being rejected, send out a notification to the nominating individual, if send_notifications is enabled.
         */
        if ( in_array( $shelter->post_status, [ 'pending', 'draft' ] )
            && isset($_POST['save_shelter_as_trash'])
            && isset($_POST['cp_shelter_rejection_reason'])) {

            $reason = $_POST['cp_shelter_rejection_reason'];

            // If this is being marked as a duplicate, let's re-assign any nominations from it and save them to the existing shelter
            if ( $reason === 'duplicate' && is_numeric( $_POST['cp_duplicate_shelter_id'] ) ) {

                $parent_shelter = get_post( (int) $_POST['cp_duplicate_shelter_id'] );

                if ($parent_shelter) {

                    // We want to re-assign any nominations for the shelter that was a duplicate
                    cp_reassign_shelter_nominations( $shelter_post_id, $parent_shelter->ID );

                    update_post_meta($shelter_post_id, '_cp_rejection_reason_detail', 'duplicate_of_' . $parent_shelter->ID);
                }

            }

            // Set the rejection reason on the post
            update_post_meta( $shelter_post_id, '_cp_rejection_reason', $reason );

            /**
             * @var $logger CP_Logger
             */
            $logger = cp_get_logger();

            $logger->info(
                'Trashing shelter due to rejection: ' . $reason,
                ['params' => $_POST],
                'shelter_account',
                'cp_shelter',
                $shelter_post_id
            );

            // Retrieve the shelter manager of the other shelter
            $user_id = cp_get_shelter_manager_id( $shelter_post_id );

            // Trash the shelter as it will not be participating
            wp_trash_post( $shelter_post_id );

            // After the original shelter has been trashed, let's update the shelter duplicates for that state
            if ( $reason === 'duplicate' && isset( $parent_shelter ) && is_numeric( $parent_shelter->ID ) ) {
                // Update the duplicate check for the shelter that the duplicate was transferred to
                cp_update_duplicate_shelter_flags( $parent_shelter->ID );
            }

            // Remove shelter managers from trashed shelters, this should already have been triggered when it was trashed...
            cp_clear_bad_shelter_assignments();

            // If the shelter had a shelter manager, we want to make sure that their Active Campaign account is updated
            if ( $user_id ) {
                cp_sync_active_campaign_data( $user_id );
            }

            if ( !isset( $_POST['send_notifications'] ) ) {

                $logger->info(
                    'Email notification to nominating user was blocked from sending.',
                    ['params' => $_POST],
                    'shelter_account',
                    'cp_shelter',
                    $shelter_post_id
                );

            } else {

                // Instantiate the email classes so they are ready to send the notification
                $mailer = WC()->mailer();
                $emails = $mailer->get_emails();

                if (isset($emails['CP_Shelter_Nomination_Status_Update_Email'])) {
                    // Ensure we have the latest post object
                    $emails['CP_Shelter_Nomination_Status_Update_Email']->trigger($shelter_post_id, get_post($shelter_post_id), 'rejected_' . $reason);
                }

            }

            wp_redirect(admin_url('edit.php?post_type=cp_shelter&ids=' . $shelter_post_id));
            exit;

        } else if ($shelter->post_status === 'draft') {

            /**
             * @var $logger CP_Logger
             */
            $logger = cp_get_logger();

            /*
             * If this post had previously been trashed/rejected and is now going to a draft status,
             * we will notify the nominating user that it has now been approved.
             */
            if (!empty(get_post_meta($shelter->ID, '_cp_rejection_reason', true))) {

                delete_post_meta($shelter->ID, '_cp_rejection_reason');
                delete_post_meta($shelter->ID, '_cp_nominated_by_user_notified');

                $logger->info(
                    'Shelter has been removed from the trash and will be placed in draft status.',
                    ['params' => $_POST],
                    'shelter_account',
                    'cp_shelter',
                    $shelter->ID
                );

            }

            if ( !isset( $_POST['send_notifications'] ) ) {

                $logger->info(
                    'Email notification to nominating user was blocked from sending.',
                    ['params' => $_POST],
                    'shelter_account',
                    'cp_shelter',
                    $shelter_post_id
                );

            } else {

                // Instantiate the email classes so they are ready to send
                $mailer = WC()->mailer();
                $emails = $mailer->get_emails();

                // If the shelter is now in draft status, they have been approved.
                if (isset($emails['CP_Shelter_Nomination_Status_Update_Email'])) {
                    $emails['CP_Shelter_Nomination_Status_Update_Email']->trigger($shelter_post_id, $shelter, 'approved');
                }

            }

            wp_redirect(admin_url('edit.php?post_type=cp_shelter&ids=' . $shelter_post_id));
            exit;

        }

    }

}

add_action('wp_insert_post', 'cp_handle_shelter_status_change', 10, 3);

/**
 * We want to ensure that any shelter details get synced over to active campaign when a shelter post is saved on the
 * admin end of the site.
 *
 * @param $shelter_post_id
 * @param $shelter
 * @param $update
 */
function cp_sync_active_campaign_on_shelter_save( $shelter_post_id, $shelter, $update ) {

    if ( is_admin() && $shelter->post_type === 'cp_shelter') {

        $shelter_manager_id = cp_get_shelter_manager_id( $shelter_post_id );

        if( $shelter_manager_id ) {
            cp_sync_active_campaign_data( $shelter_manager_id );
        }
    }
}

add_action( 'wp_insert_post', 'cp_sync_active_campaign_on_shelter_save', 20, 3 );

/**
 * If a shelter manager is attempting to access the dashboard, re-direct them to the shelter resources.
 */
function cp_redirect_to_shelter_resources_if_shelter_role()
{
    global $post, $wp;

    $request = explode('/', $wp->request);

    if (!is_user_logged_in()
        || ($post && $post->post_name !== 'member-dashboard')
        || (isset($request[1]) && in_array($request[1], ['edit-shelter', 'customer-logout', 'shelter-resources', 'optout-shelter']))) {
        return;
    }

    $current_user = wp_get_current_user();
    $role_name    = $current_user->roles[0];

    if ('shelter_manager' === $role_name) {
        // Make sure they have a shelter assigned to them
        if (cp_get_shelter_by_manager_id($current_user->ID) !== false) {
            wp_redirect(wc_get_account_endpoint_url('shelter-resources'));
            exit;
        } else {
            wp_redirect(home_url());
            exit;
        }
    }

}

add_action('template_redirect', 'cp_redirect_to_shelter_resources_if_shelter_role');

/**
 *
 */
function cp_update_duplicate_shelter_flags( $post_id = null )
{
    global $wpdb;

    $total_duplicates = 0;

    $logger = cp_get_logger();
    $logger->info( 'Running ' . __FUNCTION__, [ 'args' => $post_id ], 'general' );

    /*
     * If a single post_id is being provided, we will update all the shelters for the state that is
     * associated with that shelter. If there isn't a state set, we will end processing immediately.
     */
    if ( $post_id !== null && is_numeric( $post_id ) ) {
        $state = get_post_meta($post_id, 'state', true );
        if ( $state ) {
            $state_clause = " AND pm1.meta_value = '{$state}'";
        } else {
            return false;
        }
    }

    /*
     * We are going to grab all the shelters in a single query. We will then group all of them by state and then
     * perform a comparison against all the shelters that are within that state.
     */
    $query = "SELECT p.*,
                     p.post_title as `name`,
                     pm1.meta_value as `state`,
                     pm2.meta_value as `city`,
                     pm3.meta_value as `website`,
                     pm4.meta_value as `email`,
                     pm5.meta_value as `ein`,
                     pm6.meta_value as `zip_code`
              FROM {$wpdb->posts} p 
              INNER JOIN {$wpdb->postmeta} pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'state' )
              INNER JOIN {$wpdb->postmeta} pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'city' )
              LEFT JOIN  {$wpdb->postmeta} pm3 ON ( p.ID = pm3.post_id AND pm3.meta_key = 'website' )
              LEFT JOIN  {$wpdb->postmeta} pm4 ON ( p.ID = pm4.post_id AND pm4.meta_key = 'email' )
              LEFT JOIN  {$wpdb->postmeta} pm5 ON ( p.ID = pm5.post_id AND pm5.meta_key = 'ein' )
              LEFT JOIN  {$wpdb->postmeta} pm6 ON ( p.ID = pm6.post_id AND pm6.meta_key = 'zip_code' )
              WHERE p.post_status != 'trash'
              " . ( ( isset( $state_clause ) ?  $state_clause : '' ) ) . "
              ORDER BY p.post_status, pm1.meta_value ASC";

    $shelters = $wpdb->get_results( $query, ARRAY_A );

    if ($shelters && count($shelters) > 0) {

        $shelters_by_state = [];

        foreach ($shelters as $shelter) {
            if ($shelter['state']) {
                $shelters_by_state[ $shelter['state'] ][] = $shelter;
            }
        }

        // Free up a bit of memory in order to save the environment.
        unset($shelters);

        if (count($shelters_by_state) > 0) {

            foreach ($shelters_by_state as $state => $state_shelters) {

                foreach ($state_shelters as $shelter_key => $state_shelter) {

                    $duplicates     = [];
                    $has_duplicates = 0;

                    // We don't want it to compare against itself...
                    unset($state_shelters[$shelter_key]);

                    if ( count( $state_shelters ) > 1) {
                        $duplicates     = cp_get_duplicate_shelter_scores( $state_shelter, $state_shelters );
                        $has_duplicates = ( count( $duplicates ) > 0 ) ? 1 : 0;
                    }

                    // Add the shelter back into the array
                    $state_shelters[$shelter_key] = $state_shelter;

                    $total_duplicates += count( $duplicates );

                    // Save whether the current shelter has any duplicates or not
                    update_post_meta( $state_shelter['ID'], '_cp_has_shelter_duplicates', $has_duplicates );

                    if ( $has_duplicates === 1) {

                        $save_duplicates = [];

                        foreach( $duplicates as $duplicate ) {
                            $save_duplicates[] = $duplicate['ID'];
                        }

                        update_post_meta( $state_shelter['ID'], '_cp_shelter_duplicates', $save_duplicates );
                        update_post_meta( $state_shelter['ID'], '_cp_shelter_duplicate_scores', $duplicates );

                    } else {

                        delete_post_meta( $state_shelter['ID'], '_cp_shelter_duplicates' );
                        delete_post_meta( $state_shelter['ID'], '_cp_shelter_duplicate_scores' );

                    }

                }

            }

        }

    }

    $logger->info( 'Total duplicates detected and updated: ' . $total_duplicates, [ 'args' => $post_id ], 'general' );

    return true;

}

/**
 *
 * For an accurate comparison, the $shelter_values and the $comparison_shelters' values should have values for:
 * name, city, website, email, and ein
 *
 * @param $shelter_values
 * @param $comparison_shelters
 * @param int $flag_score_limit
 * @return array sorted by highest score
 */
function cp_get_duplicate_shelter_scores($shelter_values, $comparison_shelters, $flag_score_limit = 50 )
{
    $potential_duplicates = [];

    foreach ($comparison_shelters as $comparison_shelter) {

        $scores  = [];
        $percent = 0;

        // Give the name less weight
        if (isset($shelter_values['name'])
            && !empty($shelter_values['name'])
            && isset($comparison_shelter['name'])
            && !empty($comparison_shelter['name'])) {

            similar_text(strtolower(trim($comparison_shelter['name'])), strtolower(trim($shelter_values['name'])), $percent);
            $scores['name'] = $percent * 0.75;
        }

        // Give the city less weight
        if (isset($shelter_values['city'])
            && !empty($shelter_values['city'])
            && isset($comparison_shelter['city'])
            && !empty($comparison_shelter['city'])) {

            similar_text(strtolower(trim($comparison_shelter['city'])), strtolower(trim($shelter_values['city'])), $percent);
            $scores['city'] = $percent * 0.5;
        }

        // Give the zip less weight
        if (isset($shelter_values['zip_code'])
            && !empty($shelter_values['zip_code'])
            && isset($comparison_shelter['zip_code'])
            && !empty($comparison_shelter['zip_code'])) {

            similar_text(preg_replace('/[^0-9]/', '', $comparison_shelter['zip_code']), preg_replace('/[^0-9]/', '', $shelter_values['zip_code']), $percent);
            $scores['zip_code'] = $percent * 0.5;
        }

        if (isset($shelter_values['website'])
            && !empty($shelter_values['website'])
            && isset($comparison_shelter['website'])
            && !empty($comparison_shelter['website'])) {

            $shelter_url            = parse_url(strtolower(trim($shelter_values['website'])));
            $shelter_website        = $shelter_url['host'] . $shelter_url['path'] . ((isset($shelter_url['query']) && !empty($shelter_url['query'])) ? '?' . $shelter_url['query'] : '');
            $comparison_shelter_url = parse_url(strtolower(trim($comparison_shelter['website'])));
            $comparison_website     = $comparison_shelter_url['host'] . $comparison_shelter_url['path'] . ((isset($comparison_shelter_url['query']) && !empty($comparison_shelter_url['query'])) ? '?' . $comparison_shelter_url['query'] : '');

            similar_text($comparison_website, $shelter_website, $percent);
            $scores['website'] = $percent * 0.75;
        }

        if (isset($shelter_values['email'])
            && !empty($shelter_values['email'])
            && isset($comparison_shelter['email'])
            && !empty($comparison_shelter['email'])) {

            similar_text(strtolower(trim($comparison_shelter['email'])), strtolower(trim($shelter_values['email'])), $percent);
            $scores['email'] = $percent;
        }

        if (isset($shelter_values['ein'])
            && !empty($shelter_values['ein'])
            && isset($comparison_shelter['ein'])
            && !empty($comparison_shelter['ein'])) {

            similar_text(preg_replace('/\D/', '', $comparison_shelter['ein']), preg_replace('/\D/', '', $shelter_values['ein']), $percent);
            $scores['ein'] = $percent;
        }

        $total_score = (array_sum($scores) > 0) ? array_sum($scores) / count($scores) : 0;

        // A score of 50+ means that at least a couple of the fields are a close match
        if ( $total_score > $flag_score_limit ) {
            $comparison_shelter['total_score'] = $total_score;
            $comparison_shelter['match_score'] = $scores;
            $potential_duplicates[] = $comparison_shelter;
        }

    }

    if (count($potential_duplicates) > 0) {
        usort($potential_duplicates, function ($item1, $item2) {
            return $item2['total_score'] <=> $item1['total_score'];
        });
    }

    return $potential_duplicates;

}

/**
 * Perform a duplicate check. If the shelter already exists, and it is 'trashed' then the shelter owner
 * has opted out of the program and we should notify the user.
 *
 * If the shelter has already been submitted, but is in 'pending' status, notify the user accordingly.
 *
 * If the shelter is already published in the system, notify the user accordingly.
 *
 * @param $values
 * @return array
 */
function cp_get_duplicate_shelters( $values )
{
    global $wpdb;

    $display_duplicate_shelters = [];

    // Retrieve all shelters from the selected state to perform a similar_text check against the values
    $query = "SELECT p.*, 
                     p.post_title as `name`,
                     pm1.meta_value as `state`,
                     pm2.meta_value as `city`,
                     pm3.meta_value as `website`,
                     pm4.meta_value as `email`,
                     pm5.meta_value as `ein`,
                     pm6.meta_value as `zip_code`
              FROM {$wpdb->posts} p 
              LEFT JOIN {$wpdb->postmeta} pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'state' )
              LEFT JOIN {$wpdb->postmeta} pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'city' )
              LEFT JOIN {$wpdb->postmeta} pm3 ON ( p.ID = pm3.post_id AND pm3.meta_key = 'website' )
              LEFT JOIN {$wpdb->postmeta} pm4 ON ( p.ID = pm4.post_id AND pm4.meta_key = 'email' )
              LEFT JOIN  {$wpdb->postmeta} pm5 ON ( p.ID = pm5.post_id AND pm5.meta_key = 'ein' )
              LEFT JOIN  {$wpdb->postmeta} pm6 ON ( p.ID = pm6.post_id AND pm6.meta_key = 'zip_code' )
              WHERE pm1.meta_value = %s
              ORDER BY p.post_status ASC";

    $results = $wpdb->get_results($wpdb->prepare($query, [$values['shelter_state']]), ARRAY_A);

    $logger = cp_get_logger();

    $logger->info('Checking new shelter nomination against ' . count($results)
        . ' shelters in the state of ' . $values['shelter_state'] .'. Nomination submitted: ' . json_encode( $values ) );

    if ($results) {

        $submitted_shelter = [
            'name'     => strtolower(trim($values['shelter_name'])),
            'city'     => strtolower(trim($values['shelter_city'])),
            'email'    => null,
            'website'  => null,
            'ein'      => null,
            'zip_code' => null
        ];

        if (isset($values['shelter_email']) && !empty($values['shelter_email'])) {
            $submitted_shelter['email'] = strtolower(trim($values['shelter_email']));
        }
        if (isset($values['shelter_website']) && !empty($values['shelter_website'])) {
            $submitted_shelter['website'] = strtolower(trim($values['shelter_website']));
            $url                          = parse_url($submitted_shelter['website']);
            $submitted_shelter['website'] = $url['host'] . $url['path'] . '?' . $url['query'];
        }
        if (isset($values['shelter_ein']) && !empty($values['shelter_ein'])) {
            $submitted_shelter['ein'] = preg_replace('/\D/', '', $values['shelter_ein']);
        }

        $potentially_duplicate_shelters = cp_get_duplicate_shelter_scores( $submitted_shelter, $results );

        $logger->info('Potential duplicates found: ' . count($potentially_duplicate_shelters)
            . '. Results: ' . json_encode( $potentially_duplicate_shelters ) );

        /*
         * If potential duplicates are found, let's filter the set a bit more as we don't want to display ALL shelter
         * status types, and if we do need to display them, we need to format the response shelters appropriately.
         */
        if ($potentially_duplicate_shelters && count($potentially_duplicate_shelters) > 0) {

            foreach ($potentially_duplicate_shelters as $shelter) {

                // We don't want to display the shelters that are either trashed or pending CP approval
                if ($shelter['post_status'] === 'trash' || $shelter['post_status'] === 'pending') {
                    continue;
                }

                // Keep consistent with what is used in the template for displaying potential duplicates
                $shelter['name']       = $shelter['post_title'];
                $shelter['shelter_id'] = $shelter['ID'];

                // Convert the shelter to an object as that is what is expected for display
                $display_duplicate_shelters[] = (object)$shelter;
            }

            if (count($display_duplicate_shelters) === 0) {

                /*
                 * We want to sort the shelters by status to show pending before trashed. For example, if
                 * a shelter has been submitted and waiting to be approved, but another was also submitted and
                 * has been marked as a duplicate (trashed), then we will display pending first.
                 */
                usort($shelters, function ($a, $b) {
                    return strcmp($a->post_status, $b->post_status);
                });

                foreach ($shelters as $shelter) {

                    if ($shelter->post_status === 'trash') {

                        return [
                            'status'  => 'shelter_found_trashed',
                            'message' => 'This shelter has chosen not to participate in the Litter for Good program. Thank you!'
                        ];

                    } else if ($shelter->post_status === 'pending') {

                        return [
                            'status'  => 'shelter_found_pending',
                            'message' => 'This shelter has already been submitted and is awaiting approval. Thank you!'
                        ];

                    }
                }

            } else {

                return [
                    'status'   => 'duplicates_found',
                    'message'  => 'We\'ve found existing shelters that may match your submission.',
                    'shelters' => $display_duplicate_shelters
                ];

            }
        }
    }

    return [
        'status' => 'no_duplicates'
    ];

}

/**
 * If a user is deleted, we need to refresh our counts as they may have nominated a shelter
 */
add_action('deleted_user', function ($user_id) {
    cp_refresh_shelter_nomination_count();
});

/**
 * De-activate current nominations for one shelter, and re-assign all of that shelter's nominations to a different
 * shelter instead.
 *
 * @param $from_shelter_id
 * @param $to_shelter_id
 * @return bool
 */
function cp_reassign_shelter_nominations($from_shelter_id, $to_shelter_id)
{

    global $wpdb;

    $from_shelter = get_post((int)$from_shelter_id);
    $to_shelter   = get_post((int)$to_shelter_id);

    // Ensure that both values passed are shelters and that the $to_shelter is not trashed
    if (!$from_shelter || $from_shelter->post_type !== 'cp_shelter'
        || !$to_shelter || $to_shelter->post_type !== 'cp_shelter' || $to_shelter->post_status === 'trash') {

        return false;

    }

    // Retrieve all current nominations for the $from_shelter
    $query       = "SELECT * FROM {$wpdb->prefix}cp_nominations WHERE shelter_post_id = %d AND active_end IS NULL";
    $nominations = $wpdb->get_results($wpdb->prepare($query, [$from_shelter_id]));

    if ($nominations && count($nominations) > 0) {

        // Insert the nomination records for the $to_shelter
        $query = "INSERT INTO {$wpdb->prefix}cp_nominations (user_id, shelter_post_id, bonus_code, bonus_multiple, bonus_first_entered)
                  SELECT user_id, %d, bonus_code, bonus_multiple, bonus_first_entered
                  FROM {$wpdb->prefix}cp_nominations 
                  WHERE shelter_post_id = %d AND active_end IS NULL";
        $wpdb->query($wpdb->prepare($query, [$to_shelter_id, $from_shelter_id]));

        $query = "UPDATE {$wpdb->prefix}cp_nominations SET active_end = NOW() WHERE shelter_post_id = %d AND active_end IS NULL";
        $wpdb->query($wpdb->prepare($query, [$from_shelter_id]));


        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();

        $logger->info(
            'Transferred nominations from a different shelter to this one.',
            ['from_shelter_id' => $from_shelter, 'to_shelter_id' => $to_shelter_id, 'nominations' => count($nominations)],
            'shelter_account',
            'cp_shelter',
            $to_shelter_id
        );

        $logger->info(
            'Transferred nominations away from this shelter and to another one.',
            ['from_shelter_id' => $from_shelter, 'to_shelter_id' => $to_shelter_id, 'nominations' => count($nominations)],
            'shelter_account',
            'cp_shelter',
            $from_shelter_id
        );

        cp_refresh_shelter_nomination_count();

    }

    return true;

}

/**
 *
 * Save a new nomination record for a user.
 *
 * @param int $user_id
 * @param int $shelter_post_id
 * @param array|null $bonus_code
 *
 * @return bool
 */
function cp_insert_user_shelter_nomination( $user_id, $shelter_post_id, $bonus_code = null )
{
    global $wpdb;

    $user    = get_user_by( 'ID', $user_id );
    $shelter = get_post( $shelter_post_id );

    if ( !$user || !$shelter ) {
        return false;
    }

    // If a bonus code is being applied to the nomination, let's set today's date as when it was first applied
    if ($bonus_code !== null) {
        $bonus_code['first_entered'] = date('Y-m-d H:i:s');
    }

    // Let's retrieve their current nomination record if they have one. We will need to end it, and retrieve any bonus
    $current_nomination = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}cp_nominations WHERE user_id = %d AND active_end IS NULL", [ (int) $user_id ]
    ));

    if ($current_nomination) {

        // If the nomination is coming in for a shelter that they already have the nomination set for, ignore this.
        if ( (int) $current_nomination->shelter_post_id === (int) $shelter_post_id ) {

            // If the user is submitting a bonus code that matches the one already attached to their nomination, exit.
            if ( $bonus_code === null
                || ( isset( $bonus_code['bonus_code'] ) && $current_nomination->bonus_code === $bonus_code['bonus_code'] ) ) {

                return false;

            }

        }

        // If the current nomination has bonus code info, and the new nomination doesn't we need to carry it over to the new
        if ($bonus_code === null && !empty( $current_nomination->bonus_code ) ) {

            $bonus_code = [
                'bonus_code'    => $current_nomination->bonus_code,
                'multiple'      => $current_nomination->bonus_multiple,
                'first_entered' => $current_nomination->bonus_first_entered
            ];

        }

        // Update the current nomination and set the active_end to now
        cp_end_current_shelter_nomination_for_user( $user_id );

    }

    $logger = cp_get_logger();

    $wpdb->insert($wpdb->prefix . 'cp_nominations', [
        'user_id'             => (int) $user_id,
        'shelter_post_id'     => (int) $shelter_post_id,
        'bonus_code'          => (isset($bonus_code['bonus_code'])) ? $bonus_code['bonus_code'] : null,
        'bonus_multiple'      => (isset($bonus_code['multiple'])) ? $bonus_code['multiple'] : null,
        'bonus_first_entered' => (isset($bonus_code['first_entered'])) ? $bonus_code['first_entered'] : null
    ], ['%d', '%d', '%s', '%s', '%s']);


    if ( !$current_nomination || (int) $current_nomination->shelter_post_id !== (int) $shelter_post_id ) {

        // Sync Active Campaign with their new shelter nomination
        cp_sync_active_campaign_contact($user_id, ['field' => ['%NOMINATED_SHELTER%,0' => (int)$shelter_post_id]]);

        $logger->info( 'Nominated the "' . $shelter->post_title . '" shelter.', [
            'shelter_post_id' => $shelter_post_id
        ], 'user_account', 'user', $user_id );

    } else {

        $logger->info( 'Updated nomination bonus code [' . $bonus_code['bonus_code'] . '] for the "' . $shelter->post_title . '" shelter.', [
            'shelter_post_id' => $shelter_post_id
        ], 'user_account', 'user', $user_id );

    }

    // Refresh the nomination count for the shelters
    cp_refresh_shelter_nomination_count();

    return true;

}

/**
 * End the current nomination for a user so that they will not have any active nominations associated
 * with their account.
 *
 * @param $user_id
 * @return false|int
 */
function cp_end_current_shelter_nomination_for_user( $user_id )
{
    global $wpdb;

    $result = $wpdb->query($wpdb->prepare(
        "UPDATE {$wpdb->prefix}cp_nominations SET active_end = NOW() WHERE user_id = %d AND active_end IS NULL", [(int)$user_id]
    ));

    cp_refresh_shelter_nomination_count();

    return $result;
}

/**
 * This function will remove a user as a shelter manager, changing their role back to customer.
 *
 * @param $user_id
 * @return bool
 */
function cp_remove_user_as_shelter_manager( $user_id )
{
    /**
     * @var $user WP_User
     */
    $user            = get_user_by( 'ID', $user_id );
    $shelter_post_id = get_user_meta( $user_id, '_cp_manage_shelter_id', true );
    $shelter         = get_post( $shelter_post_id );

    if ( !$user || !$shelter ) {
        return false;
    }

    /**
     * @var $logger CP_Logger
     */
    $logger = cp_get_logger();

    $logger->info(
        'Removing user as a shelter manager of "' . $shelter->post_title . '".',
        ['shelter_post_id' => $shelter_post_id ],
        'user_account',
        'user',
        $user_id
    );

    $logger->info(
        'Removing user ' . $user->user_email . ' as a shelter manager.',
        ['shelter_manager_id' => $user_id ],
        'shelter_account',
        'cp_shelter',
        $shelter_post_id
    );

    delete_user_meta( $user_id, '_cp_manage_shelter_id' );
    $user->set_role('customer' );

    if ( isset( $_POST['role'] ) && $_POST['role'] === 'shelter_manager' ) {
        $_POST['role'] = 'customer';
    }

    return true;

}

/**
 * We will remove the user from any current shelter management assignment that they may have, ensure that the user
 * is a shelter_manager role, if not we will set them as one. Then we will add them as the shelter manager for the
 * specified shelter.
 *
 * @todo We may want to do a check to grab any users that are set as a shelter manager for this shelter and remove them.
 *
 * @param $user_id
 * @param $shelter_post_id
 * @return false|int
 */
function cp_set_user_as_shelter_manager( $user_id, $shelter_post_id )
{
    $user    = get_user_by( 'ID', $user_id );
    $shelter = get_post( $shelter_post_id );

    if ( !$user || !$shelter ) {
        return false;
    }

    $current_shelter_id = cp_get_shelter_by_manager_id( $user_id );

    // If the user is already managing this shelter, we don't need to do anything.
    if ( $current_shelter_id == $shelter_post_id ) {
        return false;
    }

    // If the user is currently managing another shelter, they will be removed.
    cp_remove_user_as_shelter_manager( $user_id );

    /**
     * @var $logger CP_Logger
     */
    $logger = cp_get_logger();

    if ( !in_array( 'shelter_manager', $user->roles ) ) {
        $user->set_role( 'shelter_manager' );
    }

    $logger->info(
        'User ' . $user->user_email . ' assigned as a shelter manager.',
        ['shelter_manager_id' => $user_id],
        'shelter_account',
        'cp_shelter',
        $shelter_post_id
    );

    $logger->info(
        'Assigned as a shelter manager for shelter "' . $shelter->post_title . '".',
        ['shelter_post_id' => $shelter_post_id],
        'user_account',
        'user',
        $user_id
    );

    // Set the shelter as their 'favorite shelter'
    cp_insert_user_shelter_nomination( $user_id, $shelter_post_id );

    return update_user_meta( $user_id, '_cp_manage_shelter_id', $shelter_post_id, true);
}

/**
 * Retrieve the shelter transfer request for a given user_id. The user_id should be the ID of the user that is
 * being requested to take over the shelter ownership.
 *
 * @param $user_id
 * @return bool|array
 */
function cp_get_shelter_transfer_request_to_user_by_id( $user_id )
{
    global $wpdb;

    $request = false;

    $query  = "SELECT * FROM {$wpdb->usermeta} WHERE meta_value = %s AND meta_key = '_cp_transfer_shelter_to_user_id'";
    $result = $wpdb->get_row( $wpdb->prepare( $query, [ $user_id ] ) );

    if ( $result ) {

        $request['transfer_from_user_id'] = $result->user_id;
        $request['transfer_from_user']    = get_user_by('ID', $result->user_id);
        $request['transfer_to_user_id']   = $user_id;
        $request['transfer_to_user']      = get_user_by('ID', $user_id);

        $date_requested = get_user_meta( $result->user_id, '_cp_transfer_shelter_date', true );

        if ( $date_requested ) {
            $request['date_requested'] = date( 'Y-m-d', strtotime( $date_requested ) );
        }

        $shelter = cp_get_shelter_by_manager_id( $result->user_id, true );

        if ( $shelter ) {
            $request['shelter_post_id'] = $shelter->ID;
            $request['shelter'] = $shelter;
        }

    }

    return $request;
}

/**
 * Return the currently active nomination record for a user if one exists.
 *
 * @param int $user_id
 * @return null|object
 */
function cp_get_current_shelter_nomination_for_user($user_id)
{
    global $wpdb;

    $query = "SELECT * FROM {$wpdb->prefix}cp_nominations WHERE user_id = %d AND active_end IS NULL";

    return $wpdb->get_row($wpdb->prepare($query, [$user_id]));
}

/**
 * Retrieve any donations that the shelter has participated in
 *
 * @param $shelter_id
 * @param array $filters
 * @return array|null|object
 */
function cp_get_shelter_donations( $shelter_id, $filters = array() ) {

    global $wpdb;

    $where  = '';
    $params = [$shelter_id];

    // Return only donations that have not yet passed the donation end date
    if ( isset( $filters['current_only'] ) ) {
        $where .= " AND CURRENT_DATE <= pm.meta_value";
    }

    // Return only donations that are in the status provided
    if ( isset( $filters['donation_status_id'] ) ) {
        $where .= " AND ds.donation_status_id = %d";
        $params[] = $filters['donation_status_id'];
    }

    // Retrieve any donations that the shelter is a part of that have not expired
    $query = $wpdb->prepare( "SELECT ds.*, pm.meta_value as donation_end_date
              FROM {$wpdb->prefix}cp_donation_shelters ds
              INNER JOIN {$wpdb->posts} p ON ( p.ID = ds.donation_post_id AND p.post_type = 'cp_donation')
              LEFT JOIN {$wpdb->postmeta} pm ON ( p.ID = pm.post_id AND pm.meta_key = '_cp_donation_end_date')
              WHERE ds.shelter_post_id = %d {$where}", $params );

    return $wpdb->get_results( $query );

}

/**
 * @param $post_id
 * @param $shelter_id
 * @param $donation_status_id
 * @return mixed
 */
function cp_update_shelter_donation_status( $post_id, $shelter_id, $donation_status_id )
{
    global $wpdb;

    $query = "UPDATE {$wpdb->prefix}cp_donation_shelters 
              SET donation_status_id = %d, date_updated = NOW()
              WHERE donation_post_id = %d AND shelter_post_id = %d;";

    return $wpdb->query( $wpdb->prepare( $query, [ $donation_status_id, $post_id, $shelter_id ] ) );

}

/**
 * @param $shelter_id
 * @return bool
 */
function cp_is_shelter_donation_status( $shelter_id, $donation_status_id ) {

    $results = cp_get_shelter_donations( $shelter_id, [ 'current_only' => true, 'donation_status_id' => $donation_status_id ] );

    return ( !$results || count( $results ) == 0 ) ? false : true;
}

/**
 * This hook is solely for the purpose of tracking user role changes.
 *
 * @param $user_id
 * @param $role
 * @param $old_roles
 */
function cp_after_user_role_update( $user_id, $role, $old_roles) {

    $logger = cp_get_logger();

    $logger->info(
        'User role updated to ' . $role . '.',
        ['previous_roles' => $old_roles],
        'user_account',
        'user',
        $user_id
    );

}

add_action( 'set_user_role', 'cp_after_user_role_update', 10, 3 );

/**
 * Add a button to the cp_shelter admin page for running the duplicate shelter check.
 */
function cp_add_action_button_js_to_head() {
    ?>
    <script>
        jQuery(function(){
            jQuery("body.post-type-cp_shelter .wrap h1").append('<a href="<?php echo admin_url( 'edit.php?post_type=cp_shelter&update_shelter_duplicate_check=1' ); ?>" class="page-title-action duplicate-shelter-check">Run Duplicate Shelter Check</a>');
            jQuery("body.post-type-cp_shelter .wrap h1").append('<a href="<?php echo admin_url( 'edit.php?post_type=cp_shelter&reset_shelter_nominations=1' ); ?>" class="page-title-action reset-shelter-nomination"  onclick="return confirm(\'Are you sure you want to reset all shelter nominations?\')">Reset Shelter Nominations</a>');
        });
    </script>
    <?php
}
add_action('admin_head', 'cp_add_action_button_js_to_head');

/**
 * Include trashed posts in the back-end search for shelters
 *
 * @param WP_Query $query
 */
function cp_include_trash_in_shelter_search_filter( $query ) {

    if ( is_admin() && $query->is_main_query()
        && $query->is_search()
        && $query->query['post_type'] === 'cp_shelter'
        && isset( $_GET[ 'post_status' ] ) && $_GET[ 'post_status' ] === 'all' ) {

        $query->set( 'post_status', [
            'publish', 'future', 'draft', 'pending', 'private', 'trash'
        ] );

    }
}
//add_action( 'pre_get_posts', 'cp_include_trash_in_shelter_search_filter' );
