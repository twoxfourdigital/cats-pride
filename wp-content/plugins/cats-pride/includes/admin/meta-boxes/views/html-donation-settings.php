<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post_id;

$start_date            = get_post_meta( $post_id, '_cp_nomination_start_date', true );
$end_date              = get_post_meta( $post_id, '_cp_nomination_end_date', true );
$donation_end_date     = get_post_meta( $post_id, '_cp_donation_end_date', true );
$total_jugs_sold       = (int) get_post_meta( $post_id, '_cp_total_jugs_sold', true );
$min_amount_for_litter = (int) get_post_meta( $post_id, '_cp_minimum_amount_for_litter', true );

$start_date            = ( $start_date ) ? date('m/d/Y', strtotime( $start_date ) ) : date('m/01/Y', strtotime('-1 month' ));
$end_date              = ( $end_date ) ? date('m/d/Y', strtotime( $end_date ) ) : date('m/t/Y', strtotime('-1 month' ));
$donation_end_date     = ( $donation_end_date ) ? date('m/d/Y', strtotime( $donation_end_date ) ) : date('m/t/Y', strtotime('+1 month' ));

?>
<div class="inside cp-meta-box-donation-settings">

    <div class="cp-meta-box-donation-search-form">
        <div class="input-wrapper">
            <label for="nomination_start_date"><?php _e( 'Nomination Start Date', 'catspride' ); ?> <span class="required">*</span></label>
            <input required="required" id="nomination_start_date" class="datepicker" type="text" name="nomination_start_date" value="<?php echo $start_date; ?>" />
        </div>

        <div class="input-wrapper">
            <label for="nomination_end_date"><?php _e( 'Nomination End Date', 'catspride' ); ?> <span class="required">*</span></label>
            <input required="required" id="nomination_end_date" class="datepicker" type="text" name="nomination_end_date" value="<?php echo $end_date; ?>" />
        </div>

        <div class="input-wrapper">
            <label for="donation_end_date"><?php _e( 'Donation End Date', 'catspride' ); ?> <span class="required">*</span></label>
            <input required="required" id="donation_end_date" class="datepicker" type="text" name="donation_end_date" value="<?php echo $donation_end_date; ?>" />
        </div>

        <div class="input-wrapper">
            <label for="total_jugs_sold"><?php _e( 'Total Jugs Sold', 'catspride' ); ?> <span class="required">*</span></label>
            <input required="required" id="total_jugs_sold" type="text" name="total_jugs_sold" value="<?php echo ( !empty( $total_jugs_sold ) ) ? $total_jugs_sold : ''; ?>" />
        </div>

        <div class="input-wrapper">
            <label for="minimum_amount_for_litter"><?php _e( 'Min. Amount for Litter Donation', 'catspride' ); ?> <span class="required">*</span></label>
            <input required="required" id="minimum_amount_for_litter" type="text" name="minimum_amount_for_litter" value="<?php echo ( !empty( $min_amount_for_litter ) ) ? $min_amount_for_litter : ''; ?>" />
        </div>
    </div>

</div>