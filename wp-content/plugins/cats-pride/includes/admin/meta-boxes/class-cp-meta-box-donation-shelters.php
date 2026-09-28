<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * CP_Meta_Box_Donation_Shelters Class.
 *
 */
class CP_Meta_Box_Donation_Shelters {

    const STATUS_NOT_PARTICIPATING = 0; // This is the status set on an entry if they had been included but are now excluded
    const STATUS_PARTICIPATING = 1; // This status is set once they have been included in a donation
    const STATUS_PENDING_SHIPPING_ADDRESS_CONFIRMATION = 2; // This status is set once a notification has been sent out
    const STATUS_PENDING_DELIVERY = 3; // This status is set after they confirmed their shipping information
    const STATUS_COMPLETED = 4; // This status is set once the donation has been delivered

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output( $post ) {

        include( 'views/html-donation-shelters.php' );

    }

    public static function get_shelters( $criteria = array() )
    {
        global $wpdb;

        $params = [];
        $where  = '';

        $params[] = $criteria['post_id'];

        $start_date = ( isset( $criteria['nomination_start_date'] ) && !empty( $criteria['nomination_start_date']) ) ? date( 'Y-m-d', strtotime( $criteria['nomination_start_date'] ) ) : null;
        $end_date   = ( isset( $criteria['nomination_end_date'] ) && !empty( $criteria['nomination_end_date'] ) )    ? date( 'Y-m-d', strtotime( $criteria['nomination_end_date'] ) ) : null;

        if ( empty( $start_date ) || empty( $end_date )
            || strtotime( $start_date ) > strtotime( $end_date ) ) {

            return false;
        }

        if ( $start_date && $end_date ) {
            $where    = "AND n.active_start >= %s AND ( n.active_end IS NULL OR n.active_end <= %s)";
            $params[] = $start_date;
            $params[] = $end_date;
        }

        /*
         * Retrieve all shelters that received nominations between the provided dates, are published and have a shelter manager.
         */
        $query = $wpdb->prepare( "
                  SELECT n.shelter_post_id as shelter_post_id,
                         p.post_title as post_title,
                         ds.donation_type as donation_type,
                         ds.donation_amount as donation_amount,
                         ds.adjusted_donation_amount as adjusted_donation_amount,
                         u.user_email as shelter_manager_email,
                         pm9.meta_value as shelter_phone,
                         COALESCE(ds.donation_status_id, 0) as donation_status_id,
                         SUM(COALESCE(n.bonus_multiple, 1)) as `nominations`,
                         pm1.meta_value  as donation_shipping_address_1,
                         pm2.meta_value  as donation_shipping_address_2,
                         pm3.meta_value  as donation_shipping_city,
                         pm4.meta_value  as donation_shipping_state,
                         pm5.meta_value  as donation_shipping_zip_code,
                         pm6.meta_value  as donation_shipping_name,
                         pm7.meta_value  as donation_shipping_email,
                         pm8.meta_value  as donation_shipping_phone,
                         pm10.meta_value as donation_pickup_from_warehouse,
                         pm11.meta_value as donation_pickup_location,
                         pm12.meta_value as donation_provide_freight_quote,
                         pm13.meta_value as donation_has_loading_dock,
                         pm14.meta_value as donation_has_forklift,
                         pm15.meta_value as donation_delivery_time,
                         pm16.meta_value as donation_business_hours,
                         pm17.meta_value as donation_residential_delivery
                  FROM {$wpdb->prefix}cp_nominations n
                  INNER JOIN {$wpdb->posts} p ON ( p.ID = n.shelter_post_id )
                  INNER JOIN {$wpdb->usermeta} um ON ( um.meta_key = '_cp_manage_shelter_id' AND um.meta_value = p.ID )
                  INNER JOIN {$wpdb->users} u ON ( u.ID = um.user_id )
                  LEFT JOIN {$wpdb->prefix}cp_donation_shelters ds ON ( p.ID = ds.shelter_post_id AND ds.donation_post_id = %s )
                  LEFT JOIN wp_postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'donation_shipping_address_1')
                  LEFT JOIN wp_postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'donation_shipping_address_2')
                  LEFT JOIN wp_postmeta pm3 ON (p.ID = pm3.post_id AND pm3.meta_key = 'donation_shipping_city')
                  LEFT JOIN wp_postmeta pm4 ON (p.ID = pm4.post_id AND pm4.meta_key = 'donation_shipping_state')
                  LEFT JOIN wp_postmeta pm5 ON (p.ID = pm5.post_id AND pm5.meta_key = 'donation_shipping_zip_code')
                  LEFT JOIN wp_postmeta pm6 ON (p.ID = pm6.post_id AND pm6.meta_key = 'donation_shipping_name')
                  LEFT JOIN wp_postmeta pm7 ON (p.ID = pm7.post_id AND pm7.meta_key = 'donation_shipping_email')
                  LEFT JOIN wp_postmeta pm8 ON (p.ID = pm8.post_id AND pm8.meta_key = 'donation_shipping_phone')
                  LEFT JOIN wp_postmeta pm9 ON (p.ID = pm9.post_id AND pm9.meta_key = 'phone')
                  LEFT JOIN wp_postmeta pm10 ON (p.ID = pm10.post_id AND pm10.meta_key = 'donation_pickup_from_warehouse')
                  LEFT JOIN wp_postmeta pm11 ON (p.ID = pm11.post_id AND pm11.meta_key = 'donation_pickup_location')
                  LEFT JOIN wp_postmeta pm12 ON (p.ID = pm12.post_id AND pm12.meta_key = 'donation_provide_freight_quote')
                  LEFT JOIN wp_postmeta pm13 ON (p.ID = pm13.post_id AND pm13.meta_key = 'donation_has_loading_dock')
                  LEFT JOIN wp_postmeta pm14 ON (p.ID = pm14.post_id AND pm14.meta_key = 'donation_has_forklift')
                  LEFT JOIN wp_postmeta pm15 ON (p.ID = pm15.post_id AND pm15.meta_key = 'donation_delivery_time')
                  LEFT JOIN wp_postmeta pm16 ON (p.ID = pm16.post_id AND pm16.meta_key = 'donation_business_hours')
                  LEFT JOIN wp_postmeta pm17 ON (p.ID = pm17.post_id AND pm17.meta_key = 'donation_residential_delivery')
                  WHERE p.post_status = 'publish' {$where}
                  GROUP BY n.shelter_post_id
                  HAVING `nominations` > 0
                  ORDER BY `nominations` DESC", $params );

        $shelters = $wpdb->get_results( $query );

        return $shelters;

    }

    /**
     * @param array $criteria
     * @return bool
     * @throws Exception
     */
    public static function send_notifications( $criteria = array() )
    {
        if ( !isset($criteria['post_id'] )
            || ( !isset($criteria['donation_type'] ) && ( !isset( $criteria['shelters'] ) || count( $criteria['shelters'] ) === 0 ) ) ) {
            return false;
        }

        $post = get_post( $criteria['post_id'] );

        // We will only send notifications if the donation batch is published
        if ( !$post || $post->post_status !== 'publish' ) {
            throw new \Exception( 'Donation has not been published. Unable to send notifications.' );
        }

        global $wpdb;

        $where  = '';
        $params = [];

        $params[] = $criteria['post_id'];

        // Only retrieve those that are of a certain donation type
        if ( isset( $criteria['donation_type'] ) ) {
            $where   .= ' AND ds.donation_type = %s';
            $params[] = $criteria['donation_type'];
        }

        // Only send to the shelters that are being provided in the request
        if ( isset( $criteria['shelters'] ) && count( $criteria['shelters'] ) > 0 ) {

            $shelter_values = array();

            foreach( $criteria['shelters'] as $shelter_id ) {
                $shelter_values[] = $shelter_id;
            }
            $shelter_values_string = implode( ', ', $shelter_values );
            $where .= ' AND ds.shelter_post_id IN ( ' . $shelter_values_string . ' )';
        }

        // Only retrieve those shelters that are in the `Participating` status
        if ( !isset( $criteria['force_notification'] ) ) {
            $where .= ' AND ds.donation_status_id = ' . self::STATUS_PARTICIPATING;
        } else {
            // If we are forcing it, we will also allow a re-send to those that are `pending shipping address confirmation` status as well.
            $where .= ' AND ds.donation_status_id IN (' . self::STATUS_PARTICIPATING .', ' . self::STATUS_PENDING_SHIPPING_ADDRESS_CONFIRMATION . ')';
        }

        $query = $wpdb->prepare("SELECT ds.id, 
                                        ds.donation_status_id,
                                        ds.donation_type,
                                        ds.donation_post_id, 
                                        ds.shelter_post_id,
                                        ds.donation_amount,
                                        ds.adjusted_donation_amount,
                                        u.user_email as shelter_manager_email
                                 FROM {$wpdb->prefix}cp_donation_shelters as ds
                                 INNER JOIN {$wpdb->usermeta} um ON ( um.meta_key = '_cp_manage_shelter_id' AND um.meta_value = ds.shelter_post_id )
                                 INNER JOIN {$wpdb->users} u ON ( u.ID = um.user_id )
                                 WHERE ds.donation_post_id = %d {$where}", $params);

        $results = $wpdb->get_results( $query );

        if ( $results && count( $results ) > 0 ) {

            // Instantiate the email classes so they are ready to send
            $mailer = WC()->mailer();
            $emails = $mailer->get_emails();

            foreach ( $results as $donation ) {

                if ( $donation->adjusted_donation_amount == 0 ) {
                    continue;
                }

                $donation_amount = ( !empty( $donation->adjusted_donation_amount ) && $donation->adjusted_donation_amount > 0 ) ? $donation->adjusted_donation_amount : $donation->donation_amount;

                if ( $donation->donation_type === 'coupon' && isset( $emails['CP_Litter_Donation_Confirm_Shipping_Details_Coupon_Email'] ) ) {

                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Coupon_Email']->donation_amount = $donation_amount;
                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Coupon_Email']->recipient = $donation->shelter_manager_email;
                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Coupon_Email']->trigger(null, null, null);

                } else if ( $donation->donation_type === 'litter' && isset( $emails['CP_Litter_Donation_Confirm_Shipping_Details_Email'] ) ) {

                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Email']->donation_amount = $donation_amount;
                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Email']->recipient = $donation->shelter_manager_email;
                    $emails['CP_Litter_Donation_Confirm_Shipping_Details_Email']->trigger(null, null, null);

                }

                // If the shelter donation status isn't set to pending shipping address confirmation, let's do that.
                if ( (int) $donation->donation_status_id !== self::STATUS_PENDING_SHIPPING_ADDRESS_CONFIRMATION ) {

                    // Update the status of the shelter donation to be `pending shipping address confirmation`
                    cp_update_shelter_donation_status(
                        $donation->donation_post_id,
                        $donation->shelter_post_id,
                        self::STATUS_PENDING_SHIPPING_ADDRESS_CONFIRMATION
                    );

                }
            }
        }
    }

    public static function update_calculated_donation_settings_for_shelter( $donation_post_id )
    {
        $total_jugs     = get_post_meta( $donation_post_id, '_cp_total_jugs_sold', true );
        $start_date     = get_post_meta( $donation_post_id, '_cp_nomination_start_date', true );
        $end_date       = get_post_meta( $donation_post_id, '_cp_nomination_end_date', true );
        $min_for_litter = get_post_meta( $donation_post_id, '_cp_minimum_amount_for_litter', true );

        $shelters = self::get_shelters( [
            'post_id'               => $donation_post_id,
            'nomination_start_date' => $start_date,
            'nomination_end_date'   => $end_date
        ] );

        if ( count( $shelters ) === 0 ) {
            return false;
        }

        global $wpdb;

        $total_nominations = array_sum(array_column($shelters, 'nominations'));

        /*
         * We will only update the donation amount and donation type for those donations that are:
         * Pending Notification
         * Pending Address Confirmation
         * Pending Delivery
         *
         * Those that have already been marked as completed will not be updated.
         */
        $query = "UPDATE {$wpdb->prefix}cp_donation_shelters 
                  SET donation_amount = %s, donation_type = %s 
                  WHERE donation_post_id = %d AND shelter_post_id = %d AND donation_status_id > 0 AND donation_status_id < 4";

        foreach ( $shelters as $shelter ) {

            if ( (int) $shelter->nominations === 0) {
                continue;
            }

            $donation_amount = ( ( (int) $shelter->nominations / $total_nominations) * (int) $total_jugs );

            $wpdb->query( $wpdb->prepare( $query, [
                $donation_amount,
                ( $donation_amount >= $min_for_litter ) ? 'litter' : 'coupon',
                $donation_post_id,
                $shelter->shelter_post_id
            ] ) );
        }

        return true;

    }

    /**
     * This will only update shelters associated with the donation if the shelter is currently in a 0 status (not participating).
     * This ensures that we don't reset a shelter's steps through the process.
     *
     * @param array $criteria
     * @return false|int
     */
    public static function include_in_donation( $criteria = array() )
    {
        if ( !isset( $criteria['post_id'] ) || !isset( $criteria['shelters'] ) || count( $criteria['shelters'] ) === 0 ) {
            return false;
        }

        global $wpdb;

        $post_id = $criteria['post_id'];
        $values  = [];

        foreach( $criteria['shelters'] as $shelter_id ) {
            $insert_values = '(' . $post_id . ', ' . $shelter_id . ', ' . self::STATUS_PARTICIPATING . ',  NOW(), NOW())';
            $values[] = $insert_values;
        }
        $values = implode( ', ', $values );

        $query = "INSERT INTO {$wpdb->prefix}cp_donation_shelters (donation_post_id, shelter_post_id, donation_status_id, date_created, date_updated) 
                  VALUES
                  {$values}
                  ON DUPLICATE KEY UPDATE 
                    donation_status_id = IF( donation_status_id = " . self::STATUS_NOT_PARTICIPATING . ", " . self::STATUS_PARTICIPATING . ", donation_status_id);";

        $wpdb->query( $query );

        self::update_calculated_donation_settings_for_shelter( $post_id );

    }

    /**
     * Mark shelters in a donation as completed if they are being passed and their current status is one of the following:
     * - Participating
     * - Pending address confirmation
     * - Pending delivery
     *
     * @param array $criteria
     * @return false|int
     */
    public static function mark_as_delivered( $criteria = array() )
    {
        if ( !isset( $criteria['post_id'] ) || !isset( $criteria['shelters'] ) || count( $criteria['shelters'] ) === 0 ) {
            return false;
        }

        global $wpdb;

        $post_id        = $criteria['post_id'];
        $params         = [];
        $shelter_values = [];

        $params[] = self::STATUS_COMPLETED;
        $params[] = $post_id;
        $params[] = self::STATUS_PARTICIPATING;
        $params[] = self::STATUS_PENDING_SHIPPING_ADDRESS_CONFIRMATION;
        $params[] = self::STATUS_PENDING_DELIVERY;

        foreach( $criteria['shelters'] as $shelter_id ) {
            $shelter_values[] = $shelter_id;
        }
        $shelter_values_string = implode( ', ', $shelter_values );

        $query = "UPDATE {$wpdb->prefix}cp_donation_shelters 
                  SET donation_status_id = %d, date_updated = NOW()
                  WHERE donation_post_id = %d 
                    AND donation_status_id IN ( %d, %d, %d )
                    AND shelter_post_id IN ( {$shelter_values_string} );";

        return $wpdb->query( $wpdb->prepare( $query, $params ) );

    }

    /**
     * This will delete any shelters that are marked as not participating in the donation batch, unless they have
     * already been set as a completed status.
     *
     * @param array $criteria
     * @return false|int
     */
    public static function exclude_from_donation( $criteria = array() )
    {
        if ( !isset( $criteria['post_id'] ) || !isset( $criteria['shelters'] ) || count( $criteria['shelters'] ) === 0 ) {
            return false;
        }

        global $wpdb;

        $post_id = $criteria['post_id'];
        $shelter_values = [];

        foreach( $criteria['shelters'] as $shelter_id ) {
            $shelter_values[] = $shelter_id;
        }
        $shelter_values_string = implode( ', ', $shelter_values );

        $query = $wpdb->prepare( "DELETE FROM {$wpdb->prefix}cp_donation_shelters 
                                  WHERE donation_post_id = %d 
                                    AND shelter_post_id IN ( {$shelter_values_string} ) 
                                    AND donation_status_id < 4", [ $post_id ] );

        $wpdb->query( $query );

        return true;
    }

    /**
     * Save meta box data.
     *
     * @param int $post_id
     * @param $post
     */
    public static function save( $post_id, $post ) {

        if ( isset( $_POST['total_jugs_sold'] ) && !empty( $_POST['total_jugs_sold'] ) && is_numeric( $_POST['total_jugs_sold'] ) ) {
            update_post_meta( $post_id, '_cp_total_jugs_sold', (int) $_POST['total_jugs_sold'] );
        }

        if ( isset( $_POST['nomination_start_date'] ) && !empty( $_POST['nomination_start_date'] ) && date('Y-m-d', strtotime( $_POST['nomination_start_date'] ) ) ) {
            update_post_meta( $post_id, '_cp_nomination_start_date', date('Y-m-d', strtotime( $_POST['nomination_start_date'] ) ) );
        }

        if ( isset( $_POST['nomination_end_date'] ) && !empty( $_POST['nomination_end_date'] ) && date('Y-m-d', strtotime( $_POST['nomination_end_date'] ) ) ) {
            update_post_meta( $post_id, '_cp_nomination_end_date', date('Y-m-d', strtotime( $_POST['nomination_end_date'] ) ) );
        }

        if ( isset( $_POST['minimum_amount_for_litter'] ) && !empty( $_POST['minimum_amount_for_litter'] ) && is_numeric( $_POST['minimum_amount_for_litter'] ) ) {
            update_post_meta( $post_id, '_cp_minimum_amount_for_litter', (int) $_POST['minimum_amount_for_litter'] );
        }

        if ( isset( $_POST['donation_end_date'] ) && !empty( $_POST['donation_end_date'] ) && date('Y-m-d', strtotime( $_POST['donation_end_date'] ) ) ) {
            update_post_meta( $post_id, '_cp_donation_end_date', date('Y-m-d', strtotime( $_POST['donation_end_date'] ) ) );
        }

        // If the nomination period, total juhs sold or min amount for litter donation changed, we need to update the records
        self::update_calculated_donation_settings_for_shelter( $post_id );
        
        if ( isset( $_POST['shelters'] ) && count( $_POST['shelters'] ) > 0 ) {

            global $wpdb;

            foreach( $_POST['shelters'] as $shelter_id => $values ) {

                // Set the donation type and adjusted amount for the shelters in the $_POST, just in case any of them changed values
                $wpdb->query( $wpdb->prepare( "
                    UPDATE {$wpdb->prefix}cp_donation_shelters 
                    SET donation_type = %s, 
                        adjusted_donation_amount = %s 
                    WHERE shelter_post_id = %d 
                      AND donation_post_id = %d",
                    [
                        $values['donation_type'],
                        ( $values['adjusted_donation_amount'] && is_numeric( $values['adjusted_donation_amount'] ) && $values['adjusted_donation_amount'] > 0 ) ? (float) $values['adjusted_donation_amount'] : null,
                        $shelter_id,
                        $post_id
                    ]
                ) );

            }

        }

    }

}
