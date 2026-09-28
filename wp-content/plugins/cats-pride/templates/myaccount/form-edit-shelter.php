<?php
/**
 * Edit shelter form
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$user_id           = get_current_user_id();
$user              = get_user_by('ID', $user_id);
$manage_shelter_id = get_user_meta( $user_id, '_cp_manage_shelter_id', true );

// Retrieve the user's favorite/nominated shelter
$manage_shelter    = ($manage_shelter_id) ? get_post( $manage_shelter_id ) : false;

// Has the shelter manager submitted a request to another user for management of their shelter?
$transfer_request_user_id = get_user_meta( $user_id, '_cp_transfer_shelter_to_user_id', true );
$transfer_request_date    = get_user_meta( $user_id, '_cp_transfer_shelter_date', true );

if ( !empty( $transfer_request_user_id ) && is_numeric( $transfer_request_user_id ) ) {
    $transfer_request  = true;
    $transfer_to_user  = get_user_by('ID', (int) $transfer_request_user_id );
    $transfer_to_email =  ( $transfer_to_user ) ? $transfer_to_user->user_email : false;
} else {
    $transfer_request  = false;
}

// Get states for select population
$countries_obj = new WC_Countries();
$countries = $countries_obj->__get('countries');
$default_country = $countries_obj->get_base_country();
$default_country_states = $countries_obj->get_states( $default_country );

// Populate form values
$shelter_name      = ( isset( $_POST['shelter_name'] ) ) ? $_POST['shelter_name'] : $manage_shelter->post_title;
$shelter_email     = $user->user_email;
$shelter_ein       = ( isset( $_POST['shelter_ein'] ) ) ? $_POST['shelter_ein'] : get_field( 'ein', $manage_shelter_id );
$shelter_address_1 = ( isset( $_POST['shelter_address_1'] ) ) ? $_POST['shelter_address_1'] : get_field( 'address_1', $manage_shelter_id );
$shelter_address_2 = ( isset( $_POST['shelter_address_2'] ) ) ? $_POST['shelter_address_2'] : get_field( 'address_2', $manage_shelter_id );
$shelter_city      = ( isset( $_POST['shelter_city'] ) ) ? $_POST['shelter_city'] : get_field( 'city', $manage_shelter_id );
$shelter_state     = ( isset( $_POST['shelter_state'] ) ) ? $_POST['shelter_state'] : get_field( 'state', $manage_shelter_id );
$shelter_zip_code  = ( isset( $_POST['shelter_zip_code'] ) ) ? $_POST['shelter_zip_code'] : get_field( 'zip_code', $manage_shelter_id );

$shelter_phone     = ( isset( $_POST['shelter_phone'] ) ) ? $_POST['shelter_phone'] : get_field( 'phone', $manage_shelter_id );
$shelter_contact   = ( isset( $_POST['shelter_contact'] ) ) ? $_POST['shelter_contact'] : get_field( 'contact', $manage_shelter_id );
$shelter_website   = ( isset( $_POST['shelter_website'] ) ) ? $_POST['shelter_website'] : get_field( 'website', $manage_shelter_id );
$shelter_facebook  = ( isset( $_POST['shelter_facebook'] ) ) ? $_POST['shelter_facebook'] : get_field( 'facebook', $manage_shelter_id );
$shelter_twitter   = ( isset( $_POST['shelter_twitter'] ) ) ? $_POST['shelter_twitter'] : get_field( 'twitter', $manage_shelter_id );
$shelter_instagram = ( isset( $_POST['shelter_instagram'] ) ) ? $_POST['shelter_instagram'] : get_field( 'instagram', $manage_shelter_id );

// Populate donation shipping contact and address values
$shelter_donation_shipping_address_1 = ( isset( $_POST['shelter_donation_shipping_address_1'] ) ) ? $_POST['shelter_donation_shipping_address_1'] : get_field( 'donation_shipping_address_1', $manage_shelter_id );
$shelter_donation_shipping_address_2 = ( isset( $_POST['shelter_donation_shipping_address_2'] ) ) ? $_POST['shelter_donation_shipping_address_2'] : get_field( 'donation_shipping_address_2', $manage_shelter_id );
$shelter_donation_shipping_city      = ( isset( $_POST['shelter_donation_shipping_city'] ) ) ? $_POST['shelter_donation_shipping_city'] : get_field( 'donation_shipping_city', $manage_shelter_id );
$shelter_donation_shipping_state     = ( isset( $_POST['shelter_donation_shipping_state'] ) ) ? $_POST['shelter_donation_shipping_state'] : get_field( 'donation_shipping_state', $manage_shelter_id );
$shelter_donation_shipping_zip_code  = ( isset( $_POST['shelter_donation_shipping_zip_code'] ) ) ? $_POST['shelter_donation_shipping_zip_code'] : get_field( 'donation_shipping_zip_code', $manage_shelter_id );
$shelter_donation_shipping_name      = ( isset( $_POST['shelter_donation_shipping_name'] ) ) ? $_POST['shelter_donation_shipping_name'] : get_field( 'donation_shipping_name', $manage_shelter_id );
$shelter_donation_shipping_phone     = ( isset( $_POST['shelter_donation_shipping_phone'] ) ) ? $_POST['shelter_donation_shipping_phone'] : get_field( 'donation_shipping_phone', $manage_shelter_id );
$shelter_donation_shipping_email     = ( isset( $_POST['shelter_donation_shipping_email'] ) ) ? $_POST['shelter_donation_shipping_email'] : get_field( 'donation_shipping_email', $manage_shelter_id );

// Delivery / Pickup details
$shelter_donation_pickup_from_warehouse = ( isset( $_POST['shelter_donation_pickup_from_warehouse'] ) ) ? $_POST['shelter_donation_pickup_from_warehouse'] : get_field( 'donation_pickup_from_warehouse', $manage_shelter_id );
$shelter_donation_pickup_location       = ( isset( $_POST['shelter_donation_pickup_location'] ) ) ? $_POST['shelter_donation_pickup_location'] : get_field( 'donation_pickup_location', $manage_shelter_id );
$shelter_donation_provide_freight_quote = ( isset( $_POST['shelter_donation_provide_freight_quote'] ) ) ? $_POST['shelter_donation_provide_freight_quote'] : get_field( 'donation_provide_freight_quote', $manage_shelter_id );
$shelter_donation_has_loading_dock      = ( isset( $_POST['shelter_donation_has_loading_dock'] ) ) ? $_POST['shelter_donation_has_loading_dock'] : get_field( 'donation_has_loading_dock', $manage_shelter_id );
$shelter_donation_has_forklift          = ( isset( $_POST['shelter_donation_has_forklift'] ) ) ? $_POST['shelter_donation_has_forklift'] : get_field( 'donation_has_forklift', $manage_shelter_id );
$shelter_donation_delivery_time         = ( isset( $_POST['shelter_donation_delivery_time'] ) ) ? $_POST['shelter_donation_delivery_time'] : get_field( 'donation_delivery_time', $manage_shelter_id );
$shelter_donation_business_hours        = ( isset( $_POST['shelter_donation_business_hours'] ) ) ? $_POST['shelter_donation_business_hours'] : get_field( 'donation_business_hours', $manage_shelter_id );
$shelter_donation_residential_delivery  = ( isset( $_POST['shelter_donation_residential_delivery'] ) ) ? $_POST['shelter_donation_residential_delivery'] : get_field( 'donation_residential_delivery', $manage_shelter_id );

// Retrieve any donations this shelter is currently participating in
$shelter_donations     = cp_get_shelter_donations( $manage_shelter_id, [ 'current_only' => true, 'donation_status_id' => 2 ] );
$shelter_donation_type = 'coupon';

if ( $shelter_donations && count( $shelter_donations ) > 0 ) {
    foreach( $shelter_donations as $donation ) {
        if ( $donation->donation_type === 'litter' ) {
            $donation_type = 'litter';
        }
    }
}

// Does the shelter have a shipping address confirmation pending?
$shelter_confirm_shipping = cp_is_shelter_donation_status(
    $manage_shelter_id,
    2 // Pending Shipping Information
);

// Is the user currently opted in to marketing? If so, don't display the opt-in checkbox
$opted_in = get_user_meta( $user_id, '_cp_marketing_opted_in', true );

do_action( 'catspride_before_edit_shelter_form' ); ?>

<div id="" class="x-section" style="margin: 0px;padding: 0px;">
	<div class="x-container max width row" style="">

		<div class="x-column x-sm x-2-3 last s-12">
			<h2 class="h-custom-headline cp-fc-header-header s-20 w-700 mobile-s-24 mobile-mbm"><?php _e('My Account', 'catspride'); ?></h2>
			<p class="mobile-s-18">Help us make your Shelter Page as informative and engaging as possible by completing the fields below. You can return to update this information at any time.</p>
		</div>
		<div class="x-column x-sm x-2-3 s-12 col-md-8">
			<div class="x-section">
				<div class="x-container max width">

					<form class="catspride-EditShelterForm edit-shelter disable-on-submit" method="post">

						<?php do_action( 'catspride_edit_shelter_form_start' ); ?>

						<?php if ( $shelter_confirm_shipping === true ) { ?>

							<h1 style="margin-bottom:30px;margin-top:30px;" id="donation_shipping"><?php _e('Donation Shipping Details', 'catspride'); ?></h1>

							<p>It's time to coordinate the Litter for Good donations to your organization! You are eligible to receive one pallet or more of scoopable litter. If your shelter is unable to accept scoopable (clumping) litter, please call <a href="tel:3127063121">(312) 706-3121</a>.</p>
							<p style="margin-bottom:30px;">Before we move forward with the litter donation order, we have a few questions we need your help on. Please complete the below and you'll be one step closer to donated cat litter!</p>
							<p>Please confirm your shipping address in order to receive your donation. We routinely require shelter manager's confirm their shipping address prior to any donation fulfillment.</p>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_address_1"><?php _e( 'Shipping Address', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_address_1" id="shelter_donation_shipping_address_1" value="<?php echo esc_attr( $shelter_donation_shipping_address_1 ); ?>" />
							</div>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_address_2"><?php _e( 'Shipping Address 2', 'catspride' ); ?></label>
								<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_address_2" id="shelter_donation_shipping_address_2" value="<?php echo esc_attr( $shelter_donation_shipping_address_2 ); ?>" />
							</div>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_city"><?php _e( 'Shipping City', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_city" id="shelter_donation_shipping_city" value="<?php echo esc_attr( $shelter_donation_shipping_city ); ?>" />
							</div>

							<div class="x-container form-fields">
								<div class="x-column x-sm x-1-4">
									<label for="shelter_donation_shipping_state"><?php _e( 'Shipping State', 'catspride' ); ?> <span class="required">*</span></label>
									<select required="required" class="catspride-Input catspride-Input--select input-select" name="shelter_donation_shipping_state" id="shelter_donation_shipping_state">
										<option value="">Choose ...</option>
										<?php foreach($default_country_states as $state_abbr => $state) { ?>
											<option value="<?php echo $state_abbr; ?>" <?php selected( $shelter_donation_shipping_state, $state_abbr ) ?>><?php echo $state_abbr ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="x-column x-sm x-3-4">
									<label for="shelter_donation_shipping_zip_code"><?php _e( 'Shipping Zip Code', 'catspride' ); ?> <span class="required">*</span></label>
									<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_zip_code" id="shelter_donation_shipping_zip_code" value="<?php echo esc_attr( $shelter_donation_shipping_zip_code ); ?>"/>
								</div>
							</div>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_name"><?php _e( 'Contact Full Name', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_name" id="shelter_donation_shipping_name" value="<?php echo esc_attr( $shelter_donation_shipping_name ); ?>" />
							</div>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_phone"><?php _e( 'Contact Phone Number', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_phone" id="shelter_donation_shipping_phone" value="<?php echo esc_attr( $shelter_donation_shipping_phone ); ?>" />
							</div>

							<div class="x-container form-fields">
								<label for="shelter_donation_shipping_email"><?php _e( 'Contact Email', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_donation_shipping_email" id="shelter_donation_shipping_email" value="<?php echo esc_attr( $shelter_donation_shipping_email ); ?>" />
							</div>

							<div class="x-container form-fields" style="margin-bottom: 20px;">
								<label for="shelter_donation_pickup_from_warehouse"><?php _e( 'Will you be picking up the litter donation at one of our manufacturing plants or warehouses?', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_pickup_from_warehouse" id="shelter_donation_pickup_from_warehouse_yes" value="1" <?php checked( $shelter_donation_pickup_from_warehouse, '1' ); ?> />
								<label for="shelter_donation_pickup_from_warehouse_yes"><?php _e( 'Yes', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_pickup_from_warehouse" id="shelter_donation_pickup_from_warehouse_no" value="0" <?php checked( $shelter_donation_pickup_from_warehouse, '0' ); ?> />
								<label for="shelter_donation_pickup_from_warehouse_no"><?php _e( 'No', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_pickup_from_warehouse']" data-depends-on-value="1">
								<label for="shelter_donation_pickup_location"><?php _e( 'Which plant or warehouse would you like to pick-up from?', 'catspride' ); ?> <span class="required">*</span></label>
								<select required="required" name="shelter_donation_pickup_location" id="shelter_donation_pickup_location">
									<option value="">Choose ...</option>
									<?php

									$pickup_locations = array (
										'Thomasville, GA',
										'Ripley, MS',
										'Mounds, IL',
										'Liverpool, NY',
										'Mansfield, MA',
										'Portland, OR'
									);

									foreach( $pickup_locations as $location ) { ?>
										<option value="<?php echo $location; ?>" <?php selected( $shelter_donation_pickup_location, $location ); ?>><?php echo $location ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_pickup_from_warehouse']" data-depends-on-value="0"  style="margin-bottom: 20px;">
								<label for="shelter_donation_provide_freight_quote"><?php _e( 'We are also happy to provide a third-party freight estimate for your review and approval prior to shipping the litter. Would you like a third-party freight estimate?', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_provide_freight_quote" id="shelter_donation_provide_freight_quote_yes" value="1" <?php checked( $shelter_donation_provide_freight_quote, '1' ); ?> />
								<label for="shelter_donation_provide_freight_quote_yes"><?php _e( 'Yes', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_provide_freight_quote" id="shelter_donation_provide_freight_quote_no" value="0" <?php checked( $shelter_donation_provide_freight_quote, '0' ); ?> />
								<label for="shelter_donation_provide_freight_quote_no"><?php _e( 'No', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_provide_freight_quote']" data-depends-on-value="1" style="margin-bottom: 20px;">

								<p class="desc">Complete the below shipping questions and a third-party freight estimate will be provided for your review and approval prior to the shipment of the litter. Keep in mind, the value of the donated litter is well above the cost of third-party freight.</p>

								<label for="shelter_donation_has_loading_dock"><?php _e( 'Do you have a loading dock?', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_has_loading_dock" id="shelter_donation_has_loading_dock_yes" value="1" <?php checked( $shelter_donation_has_loading_dock, '1' ); ?> />
								<label for="shelter_donation_has_loading_dock_yes"><?php _e( 'Yes', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_has_loading_dock" id="shelter_donation_has_loading_dock_no" value="0" <?php checked( $shelter_donation_has_loading_dock, '0' ); ?> />
								<label for="shelter_donation_has_loading_dock_no"><?php _e( 'No', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_provide_freight_quote']" data-depends-on-value="1" style="margin-bottom: 20px;">
								<label for="shelter_donation_has_forklift"><?php _e( 'Do you have a forklift or pallet jack?', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_has_forklift" id="shelter_donation_has_forklift_yes" value="1" <?php checked( $shelter_donation_has_forklift, '1' ); ?> />
								<label for="shelter_donation_has_forklift_yes"><?php _e( 'Yes', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_has_forklift" id="shelter_donation_has_forklift_no" value="0" <?php checked( $shelter_donation_has_forklift, '0' ); ?> />
								<label for="shelter_donation_has_forklift_no"><?php _e( 'No', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_provide_freight_quote']" data-depends-on-value="1" style="margin-bottom: 20px;">
								<label for="shelter_donation_delivery_time"><?php _e( 'Do you require a delivery appointment, or can the carrier deliver anytime during normal business?', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_delivery_time" id="shelter_donation_delivery_time_appointment" value="appointment" <?php checked( $shelter_donation_delivery_time, 'appointment' ); ?> />
								<label for="shelter_donation_delivery_time_appointment"><?php _e( 'Appointment', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_delivery_time" id="shelter_donation_delivery_time_business_hours" value="business_hours" <?php checked( $shelter_donation_delivery_time, 'business_hours' ); ?> />
								<label for="shelter_donation_delivery_time_business_hours"><?php _e( 'Business Hours', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_delivery_time']" data-depends-on-value="business_hours">
								<label for="shelter_donation_business_hours"><?php _e( 'What are your business hours?', 'catspride' ); ?> <span class="required">*</span></label>
								<textarea required="required" class="catspride-Input catspride-Input--textarea input-textarea" name="shelter_donation_business_hours" id="shelter_donation_business_hours"><?php echo $shelter_donation_business_hours; ?></textarea>
							</div>

							<div class="x-container form-fields" data-depends-on-selector=":input[name='shelter_donation_provide_freight_quote']" data-depends-on-value="1" style="margin-bottom: 20px;">
								<label for="shelter_donation_residential_delivery"><?php _e( 'Would your shelter be considered to be located in a residential neighborhood? If unsure, the answer is likely "No"', 'catspride' ); ?> <span class="required">*</span></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_residential_delivery" id="shelter_donation_residential_delivery_yes" value="1" <?php checked( $shelter_donation_residential_delivery, '1' ); ?> />
								<label for="shelter_donation_residential_delivery_yes"><?php _e( 'Yes', 'catspride' ); ?></label>
								<input required="required" type="radio" class="catspride-Input catspride-Input--radio input-radio" name="shelter_donation_residential_delivery" id="shelter_donation_residential_delivery_no" value="0" <?php checked( $shelter_donation_residential_delivery, '0' ); ?> />
								<label for="shelter_donation_residential_delivery_no"><?php _e( 'No', 'catspride' ); ?></label>
							</div>

							<div class="x-container form-fields">

								<p class="desc" style="margin-top:30px;">We're looking forward to receiving the completed questions above. We can then move forward with requesting third-party freight estimates, processing orders and coordinating the pickup and or delivery of the donations. If you have any questions at all, please call our program manager at <a href="tel:3127063121">(312) 706-3121</a>.</p>
								<p class="desc" style="margin-bottom:30px;">Thank you for helping us change litter for good.</p>

								<input type="checkbox" style="margin-right:10px;" class="catspride-Input catspride-Input--checkbox input-checkbox" name="shelter_donation_confirmation" id="shelter_donation_confirmation" value="1" required="required" />
								<label for="shelter_donation_confirmation"><?php _e( 'I confirm that the shipping details above are accurate.', 'catspride' ); ?></label>
							</div>

							<hr>
							<div class="x-container" style="margin-bottom:60px;">
								<a class="primary-button--light-blue" style="margin-right:15px;" href="<?php echo wc_get_endpoint_url('shelter-resources'); ?>" title="Return to Shelter Resources">cancel</a>
								<input type="submit" class="catspride-Button button primary-button--light-blue" name="edit_shelter" value="<?php esc_attr_e( 'Save', 'catspride' ); ?>" />
							</div>

						<?php } ?>

						<div class="x-container form-fields">
							<label for="shelter_name"><?php _e( 'Shelter\'s Name', 'catspride' ); ?> <span class="required">*</span></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_name" id="shelter_name" value="<?php echo esc_attr( $shelter_name ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_email"><?php _e( 'Email', 'catspride' ); ?></label>
							<input type="text" readonly class="catspride-Input catspride-Input--text input-text" name="shelter_email" id="shelter_email" value="<?php echo esc_attr( $shelter_email ); ?>" />
							<p class="description" style="font-style:italic;">Need to update your shelter's email? Contact us at <a href="mailto:litterforgood@catspride.com">litterforgood@catspride.com</a> to let us know.</p>
						</div>

						<div class="x-container form-fields">
							<label for="shelter_ein"><?php _e( 'Shelter EIN', 'catspride' ); ?> <span class="required">*</span>
								<br><span class="s-11">(Employer Identification Number, a 9-digit number assigned by the IRS)</span>
							</label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_ein" id="shelter_ein" value="<?php echo esc_attr( $shelter_ein ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_address_1"><?php _e( 'Address', 'catspride' ); ?> <span class="required">*</span></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_address_1" id="shelter_address_1" value="<?php echo esc_attr( $shelter_address_1 ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_address_2"><?php _e( 'Address 2', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_address_2" id="shelter_address_2" value="<?php echo esc_attr( $shelter_address_2 ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_city"><?php _e( 'City', 'catspride' ); ?> <span class="required">*</span></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_city" id="shelter_city" value="<?php echo esc_attr( $shelter_city ); ?>" />
						</div>

						<div class="x-container form-fields">
							<div class="x-column x-sm x-1-4 mobile-remove-gutters">
								<label for="shelter_state"><?php _e( 'State', 'catspride' ); ?> <span class="required">*</span></label>
								<select class="catspride-Input catspride-Input--select input-select" name="shelter_state" id="shelter_state">
									<option value="">Choose ...</option>
									<?php foreach($default_country_states as $state_abbr => $state) { ?>
										<option value="<?php echo $state_abbr; ?>" <?php selected( $shelter_state, $state_abbr ) ?>><?php echo $state_abbr ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="x-column x-sm x-3-4 mobile-remove-gutters">
								<label for="shelter_zip_code"><?php _e( 'Zip Code', 'catspride' ); ?> <span class="required">*</span></label>
								<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_zip_code" id="shelter_zip_code" value="<?php echo esc_attr( $shelter_zip_code ); ?>"/>
							</div>
						</div>

						<div class="x-container form-fields">
							<label for="shelter_phone"><?php _e( 'Phone Number', 'catspride' ); ?> <span class="required">*</span></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_phone" id="shelter_phone" value="<?php echo esc_attr( $shelter_phone ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_contact"><?php _e( 'Contact Full Name', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_contact" id="shelter_contact" value="<?php echo esc_attr( $shelter_contact ); ?>" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_website"><?php _e( 'Website', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_website" id="shelter_website" value="<?php echo esc_attr( $shelter_website ); ?>" placeholder="http://" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_facebook"><?php _e( 'Facebook', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_facebook" id="shelter_facebook" value="<?php echo esc_attr( $shelter_facebook ); ?>" placeholder="http://" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_twitter"><?php _e( 'Twitter', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_twitter" id="shelter_twitter" value="<?php echo esc_attr( $shelter_twitter ); ?>" placeholder="http://" />
						</div>

						<div class="x-container form-fields">
							<label for="shelter_instagram"><?php _e( 'Instagram', 'catspride' ); ?></label>
							<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_instagram" id="shelter_instagram" value="<?php echo esc_attr( $shelter_instagram ); ?>" placeholder="http://" />
						</div>

						<div class="x-container form-fields">
							<div class="x-column x-sm x-1-1 mobile-remove-gutters">
								<label for="password_current"><?php _e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--password input-text mobile-100 mobile-max-100" name="password_current" id="password_current" style="max-width:294px" />
							</div>
						</div>

						<div class="x-container form-fields">
							<div class="x-column x-sm x-1-2 mobile-remove-gutters">
								<label for="password_1"><?php _e( 'New Password', 'woocommerce' ); ?></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
							</div>
							<div class="x-column x-sm x-1-2 mobile-remove-gutters">
								<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
							</div>
						</div>

						<?php if ( empty( $opted_in ) || $opted_in == '0' ) { ?>

						<div class="x-container form-fields">
              <?php echo isset($_POST['allow_marketing_emails']); ?>
							<input type="checkbox" style="margin-right:10px;" class="catspride-Input catspride-Input--checkbox input-checkbox" name="allow_marketing_emails" id="allow_marketing_emails" value="1" <?php checked('1', (isset($_POST['allow_marketing_emails']) ? 1 : 0)); ?> />
							<label for="allow_marketing_emails"><?php _e( 'Opt-in to receive marketing emails from Cat\'s Pride', 'catspride' ); ?></label>
						</div>

          <?php } else { ?>

            <input type="hidden" name="allow_marketing_emails" value="1">

          <?php } ?>



						<?php do_action( 'catspride_edit_shelter_form' ); ?>

						<hr style="margin-top: 30px;margin-bottom: 24px;border-top: solid 1px #9b9b9b;">

						<div class="x-container">
							<?php wp_nonce_field( 'catspride-edit_shelter' ); ?>

							<input type="submit" class="catspride-Button x-btn x-btn-primary blue-alt mrl mrl primary-button--light-blue" name="edit_shelter" value="<?php esc_attr_e( 'Save', 'catspride' ); ?>" />
							<a href="<?php echo wc_get_endpoint_url('shelter-resources'); ?>" title="Return to Shelter Resources" class="primary-button--light-blue x-btn x-btn-secondary blue-alt grey">Cancel</a>

							<a style="float:right;" class="mobile-clear mobile-show mobile-mtl primary-button--light-blue" href="<?php echo wc_get_account_endpoint_url('optout-shelter'); ?>"><?php _e('Opt-out of Litter for Good', 'catspride'); ?></a>

							<input type="hidden" name="donation_type" value="<?php echo $shelter_donation_type; ?>" />
							<input type="hidden" name="action" value="edit_shelter" />
						</div>

						<?php do_action( 'catspride_edit_shelter_form_end' ); ?>
					</form>
				</div>
			</div>
		</div>
		<div class="x-column x-sm x-1-3 last s-12 col-md-4">
			<div class="x-section">
				<div style="margin: 0px auto;padding: 0px 30px;" class="x-container max width mobile-remove-gutters">
					<form class="catspride-TransferShelterForm transfer-shelter disable-on-submit" method="post">

						<?php do_action( 'catspride_transfer_shelter_form_start' ); ?>

						<h3 class="h-custom-headline cp-fc-header-header s-15 w-700 mobile-s-18"><?php _e('Transfer Account Ownership', 'catspride'); ?></h4>

						<?php if ( $transfer_request === false ) { ?>

							<div class="x-container">
								<p class="desc mobile-s-18"><?php _e( 'Want someone else to manage this shelter? You can transfer ownership to anyone else with a Cat\'s Pride Club membership (as long as they aren\'t currently managing another shelter). Once management privileges are  transferred, you will no longer be able to edit this shelter\'s profile or receive emails intended for shelter managers.', 'catspride' ); ?></p>
								<label for="shelter_transfer_email" class="s-13 w-700"><?php _e( 'Cat\'s Pride Club Member\'s Email', 'catspride' ); ?> <span class="required">*</span></label>
								<input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_transfer_email" id="shelter_transfer_email" value="" />
							</div>

							<?php do_action( 'catspride_transfer_shelter_form' ); ?>

							<div class="x-container mtm mobile-center-text">
								<?php wp_nonce_field( 'catspride-transfer_shelter', '_wpnonce_transfer_shelter' ); ?>
								<input type="submit" class="primary-button--light-blue catspride-Button button" name="transfer_shelter" value="<?php esc_attr_e( 'Send Invitation', 'catspride' ); ?>" />
								<input type="hidden" name="action" value="transfer_shelter" />
							</div>

						<?php } else if ( isset( $transfer_to_email ) && !empty( $transfer_to_email ) ) { ?>

							<div class="x-container colorbox texture equal-padding green">
								<p class="desc"><?php echo sprintf( __( 'Your transfer request is currently pending to <strong>%s</strong>. To transfer shelter ownership to a different member, you must first cancel the existing request.', 'catspride' ), $transfer_to_email ); ?></p>
								<div class="x-column x-sm x-1-1">
									<?php wp_nonce_field( 'catspride-transfer_shelter_cancel', '_wpnonce_transfer_shelter_cancel' ); ?>
									<input type="hidden" name="action" value="transfer_shelter_cancel" />
									<input type="submit" class="primary-button--light-blue catspride-Button button" name="transfer_shelter_cancel" value="<?php esc_attr_e( 'Cancel Invitation', 'catspride' ); ?>" />
								</div>
							</div>

						<?php } ?>

						<?php do_action( 'catspride_transfer_shelter_form_end' ); ?>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

<?php do_action( 'catspride_after_edit_shelter_form' ); ?>
