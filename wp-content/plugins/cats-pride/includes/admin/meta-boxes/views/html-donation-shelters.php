<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $post_id;

$start_date            = get_post_meta( $post_id, '_cp_nomination_start_date', true );
$end_date              = get_post_meta( $post_id, '_cp_nomination_end_date', true );
$donation_end_date     = get_post_meta( $post_id, '_cp_donation_end_date', true );
$total_jugs_sold       = (int) get_post_meta( $post_id, '_cp_total_jugs_sold', true );
$min_amount_for_litter = (int) get_post_meta( $post_id, '_cp_minimum_amount_for_litter', true );

?>
<div class="inside cp-meta-box-donation-shelters">

    <?php

    if ( $post->post_status === 'auto-draft' ) {

    ?>

    <h1>Getting Started</h1>
    <p>To get started with your donation batch, please enter a title above and complete the settings at right and click <code>Save Draft</code>.</p>

    <?php } else if ( empty( $start_date )
        || empty( $end_date )
        || empty( $donation_end_date )
        || empty( $total_jugs_sold )
        || empty( $min_amount_for_litter )
    ) { ?>

        <h1>Complete Donation Settings</h1>
        <p>To get started with your donation batch, please enter a title above and complete the settings at right and click <code>Save Draft</code>.</p>

    <?php } else { ?>

    <div class="cp-meta-box-donation-review">
        <div class="row no-gutters">
            <div class="col-sm">
                <div class="donation-stats-wrapper donation-total-nominations" style="margin-right:10px;">
                    <h4>Total Nominations</h4>
                    <div id="cp-donation-stats-total-nominations">
                        <span class="display-value"><span> - </span>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="donation-stats-wrapper donation-statuses" style="margin-right:10px;margin-left:10px;">
                    <h3>Statuses</h3>
                    <table>
                        <tr id="cp-donation-status-0">
                            <td class="display-name">
                                <span class="cp-donation-status-icon dashicons dashicons-no-alt"></span>
                                <label>Not Participating</label>
                            </td>
                            <td class="display-value"><span> - </span></td>
                        </tr>
                        <tr id="cp-donation-status-1">
                            <td class="display-name">
                                <span class="cp-donation-status-icon dashicons dashicons-email-alt"></span>
                                <label>Pending Notification</label>
                            </td>
                            <td class="display-value"><span> - </span></td>
                        </tr>
                        <tr id="cp-donation-status-2">
                            <td class="display-name">
                                <span class="cp-donation-status-icon dashicons dashicons-clock"></span>
                                <label>Pending Address Confirmation</label>
                            </td>
                            <td class="display-value"><span> - </span></td>
                        </tr>
                        <tr id="cp-donation-status-3">
                            <td class="display-name">
                                <span class="cp-donation-status-icon dashicons dashicons-location-alt"></span>
                                <label>Pending Delivery</label>
                            </td>
                            <td class="display-value"><span> - </span></td>
                        </tr>
                        <tr id="cp-donation-status-4">
                            <td class="display-name">
                                <span class="cp-donation-status-icon dashicons dashicons-thumbs-up"></span>
                                <label>Completed</label>
                            </td>
                            <td class="display-value"><span> - </span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm">
                <div class="donation-stats-wrapper donation-send-notifications" style="margin-left:10px;">
                    <h3>Send Pending Notifications</h3>
                    <?php if ( $post->post_status === 'publish' ) { ?>
                    <table>
                        <tr>
                            <td><label>Litter Donations</label></td>
                            <td><button id="cp_donation_shelter_send_donation_litter" class="button">Send</button></td>
                        </tr>
                        <tr>
                            <td><label>Coupon Donations</label></td>
                            <td><button id="cp_donation_shelter_send_donation_coupon" class="button">Send</button></td>
                        </tr>
                    </table>
                    <?php } else { ?>
                        <p>If you have completed the configuration of your shelters, please <code>Publish</code> the donation to enable notifications.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="cp-meta-box-donation-potential-shelters-results">
        <table class="wp-list-table widefat display fixed striped shelters-search" style="width:100%;">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Shelter</th>
                    <th>Nominations</th>
                    <th>Donation Type</th>
                    <th>Donation Amount</th>
                    <th>Adjusted Amount</th>
                    <th>Shelter Manager Email</th>
                    <th>Shelter Phone</th>
                    <th>Shipping Address 1</th>
                    <th>Shipping Address 2</th>
                    <th>Shipping City</th>
                    <th>Shipping State</th>
                    <th>Shipping Zip</th>
                    <th>Shipping Contact</th>
                    <th>Shipping Phone</th>
                    <th>Shipping Email</th>
                    <th>Pickup From Warehouse</th>
                    <th>Pickup Location</th>
                    <th>Provide Quote</th>
                    <th>Loading Dock</th>
                    <th>Forklift</th>
                    <th>Delivery Time</th>
                    <th>Business Hours</th>
                    <th>Residential</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Shelter</th>
                    <th>Nominations</th>
                    <th>Donation Type</th>
                    <th>Donation Amount</th>
                    <th>Adjusted Amount</th>
                    <th>Shelter Manager Email</th>
                    <th>Shelter Phone</th>
                    <th>Shipping Address 1</th>
                    <th>Shipping Address 2</th>
                    <th>Shipping City</th>
                    <th>Shipping State</th>
                    <th>Shipping Zip</th>
                    <th>Shipping Contact</th>
                    <th>Shipping Phone</th>
                    <th>Shipping Email</th>
                    <th>Pickup From Warehouse</th>
                    <th>Pickup Location</th>
                    <th>Provide Quote</th>
                    <th>Loading Dock</th>
                    <th>Forklift</th>
                    <th>Delivery Time</th>
                    <th>Business Hours</th>
                    <th>Residential</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="clear"></div>

    <?php } ?>

</div>