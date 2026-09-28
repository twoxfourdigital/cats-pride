<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user_id    = get_current_user_id();
$birthdate  = (isset( $_POST['birthdate'] ) && cp_validate_date( $_POST['birthdate'], 'm/d' ) ) ? $_POST['birthdate'] : get_user_meta( $user_id, 'birthdate', true );
$gender     = (isset( $_POST['gender'] ) ) ? $_POST['gender'] : get_user_meta( $user_id, 'gender', true );
$plt        = (isset( $_POST['preferred_litter_type'] ) && !empty( $_POST['preferred_litter_type'] ) ) ? $_POST['preferred_litter_type'] : get_user_meta( $user_id, 'preferred_litter_type', true );
$ppo        = (isset( $_POST['preferred_purchase_outlet'] ) ) ? $_POST['preferred_purchase_outlet'] : get_user_meta( $user_id, 'preferred_purchase_outlet', true );
$opted_in   = get_user_meta( $user_id, '_cp_marketing_opted_in', true );

if( $birthdate && !empty( $birthdate ) ) {
    $birthdate = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime( $birthdate ) ) );
    $birthdate = $birthdate->format( 'm/d' );
}

// Retrieve the user's favorite/nominated shelter
$nomination          = cp_get_current_shelter_nomination_for_user( $user_id );
$favorite_shelter_id = ( $nomination ) ? $nomination->shelter_post_id : null;
$favorite_shelter    = ($favorite_shelter_id) ? get_post( $favorite_shelter_id ) : false;

// Retrieve cat's that have already been set by the user
$cats       = isset($_POST['pet_information']) ? $_POST['pet_information'] : get_user_meta( $user_id, 'pet_information', true );

// Set the preferred litter types
$litters    = cp_get_preferred_litter_types();

do_action( 'woocommerce_before_edit_account_form' ); ?>

<?php if ( wc_notice_count() > 0 ) { ?>

    <div class="container clearfix">
        <div class="column x-sm x-1-1">
            <?php wc_print_notices(); ?>
        </div>
    </div>

<?php } ?>

<section class="section edit-account">
    <div class="container clearfix">

        <form class="woocommerce-EditAccountForm edit-account" action="" method="post">

            <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

            <div class="section clearfix" style="margin-bottom: 0;">
                <h3><?php esc_html_e('Your Information', 'catspride'); ?></h3>
                <div class="container clearfix">
                    <div class="column x-sm x-1-2">
                        <label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
                    </div>
                </div>
                <div class="container clearfix">
                    <div class="column x-sm x-1-2">
                        <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" />
                    </div>
                </div>
                <div class="container clearfix">
                    <div class="column x-sm x-1-2">
                        <label for="password_1"><?php esc_html_e( 'New Password', 'woocommerce' ); ?></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
                    </div>
                    <div class="column x-sm x-1-2">
                        <label for="password_2"><?php esc_html_e( 'Confirm New Password', 'woocommerce' ); ?></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
                    </div>
                </div>
                <div class="container clearfix">
                    <div class="column x-sm x-1-2">
                        <label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
                    </div>
                    <div class="column x-sm x-1-2">
                        <label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
                    </div>
                </div>
                <div class="container clearfix">
                    <div class="column x-sm x-1-2">
                        <div><label><?php esc_html_e( 'Gender', 'catspride' ); ?></label></div>
                        <div><input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="gender" id="gender_m" value="Male" <?php checked('Male', $gender); ?> />
                        <label for="gender_m"><?php esc_html_e( 'Male', 'catspride' ); ?></label></div>
                        <div> <input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="gender" id="gender_f" value="Female" <?php checked('Female', $gender); ?> />
                        <label for="gender_f"><?php esc_html_e( 'Female', 'catspride' ); ?></label></div>
                    </div>
                    <div class="column x-sm x-1-2">
                        <label for="birthdate"><?php esc_html_e( 'Birthday', 'woocommerce' ); ?></label>
                        <p style="font-style:italic;margin-bottom: 10px;display: block;"><?php esc_html_e( 'Enter your birthday to get fun stuff and special offers!', 'catspride' ); ?></p>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text datepicker-mm-dd" name="birthdate" id="birthdate" value="<?php echo esc_attr( $birthdate ); ?>" />
                    </div>
                </div>
            </div>

            <div class="section clearfix">
                <div class="container clearfix">
                    <h3><?php esc_html_e('Pet Information', 'catspride'); ?> <span class="required">*</span></h3>

                    <div class="clearfix cp-edit-account-pet-rows">

                        <?php $count = 1; ?>

                        <?php if(isset($cats) && is_array($cats) && count($cats) > 0) { ?>

                            <?php foreach($cats as $cat) { ?>

                                <div id="cp-edit-account-pet-row_<?php echo $count; ?>" class="form-row cp-edit-account-pet-row">
                                    <div class="column x-sm x-1-5">
                                        <label for="pet_information_name_<?php echo $count; ?>"><?php esc_html_e( 'Name of Cat', 'woocommerce' ); ?></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="pet_information[<?php echo $count; ?>][name]" id="pet_information_name_<?php echo $count; ?>" value="<?php echo esc_attr( $cat['name'] ); ?>" />
                                    </div>
                                    <div class="column x-sm x-1-5">
                                        <label for="pet_information_age_<?php echo $count; ?>"><?php esc_html_e( 'Age', 'woocommerce' ); ?></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--number input-number" name="pet_information[<?php echo $count; ?>][age]" id="pet_information_age_<?php echo $count; ?>" value="<?php echo esc_attr( $cat['age'] ); ?>" />
                                    </div>
                                    <div class="column x-sm x-1-5">
                                        <label for="pet_information_date_<?php echo $count; ?>"><?php esc_html_e( 'Adoption Date', 'woocommerce' ); ?></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text datepicker" name="pet_information[<?php echo $count; ?>][date]" id="pet_information_date_<?php echo $count; ?>" value="<?php echo esc_attr( $cat['date'] ); ?>" />
                                    </div>
                                    <div class="column x-sm x-1-5">
                                        <button id="cp-edit-account-pet-row-remove_<?php echo $count; ?>" class="cp-edit-account-pet-row-remove primary-button--purple" type="button">Remove</button>
                                    </div>
                                </div>

                                <?php $count++; ?>

                            <?php } ?>

                        <?php } else { ?>

                            <div id=" cp-edit-account-pet-row_<?php echo $count; ?>" class="form-row cp-edit-account-pet-row">
                                <div class="column x-sm x-1-5">
                                    <label for="pet_information_name_<?php echo $count; ?>"><?php esc_html_e( 'Name of Cat', 'woocommerce' ); ?></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="pet_information[<?php echo $count; ?>][name]" id="pet_information_name_<?php echo $count; ?>" value="" />
                                </div>
                                <div class="column x-sm x-1-5">
                                    <label for="pet_information_age_<?php echo $count; ?>"><?php esc_html_e( 'Age', 'woocommerce' ); ?></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--number input-number" name="pet_information[<?php echo $count; ?>][age]" id="pet_information_age_<?php echo $count; ?>" value="" />
                                </div>
                                <div class="column x-sm x-1-5">
                                    <label for="pet_information_date_<?php echo $count; ?>"><?php esc_html_e( 'Adoption Date', 'woocommerce' ); ?></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text datepicker" name="pet_information[<?php echo $count; ?>][date]" id="pet_information_date_<?php echo $count; ?>" value="" />
                                </div>
                                <div class="column x-sm x-1-5">
                                    <button id="cp-edit-account-pet-row-remove_<?php echo $count; ?>" class="primary-button--purple cp-edit-account-pet-row-remove" type="button">Remove</button>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <div class="clearfix align-left">
                        <button class=" cp-edit-account-pet-row-add primary-button--light-blue" type="button">Add another pet</button>
                    </div>

                </div>
            </div>

            <div class="section clearfix">
                <div class="container">
                    <div class="column x-sm x-1-2">
                        <h3><?php esc_html_e('Litter Preference', 'catspride'); ?></h3>
                        <div class=" clearfix">
                            <label for="preferred_litter_type"><?php esc_html_e( 'Preferred Litter Type', 'catspride' ); ?></label>
                            <select class="woocommerce-Input woocommerce-Input--select input-select" name="preferred_litter_type" id="preferred_litter_type">
                                <option value="0">Choose ...</option>
                                <?php foreach($litters as $litter) { ?>
                                    <option value="<?php echo esc_attr( $litter ); ?>" <?php selected( $litter, $plt ); ?>><?php echo $litter; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="container clearfix">
                            <div><label><?php esc_html_e( 'Preferred Purchase Outlet', 'catspride' ); ?></label></div>
                            <div><input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="preferred_purchase_outlet" id="preferred_purchase_outlet_1" value="In-store" <?php checked('In-store', $ppo); ?> />
                            <label for="preferred_purchase_outlet_1"><?php esc_html_e( 'In-store', 'catspride' ); ?></label></div>
                            <div><input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="preferred_purchase_outlet" id="preferred_purchase_outlet_2" value="Online" <?php checked('Online', $ppo); ?> />
                            <label for="preferred_purchase_outlet_2"><?php esc_html_e( 'Online', 'catspride' ); ?></label></div>
                        </div>
                    </div>
                    <div class="column x-sm x-1-2">

                        <?php if($favorite_shelter) { ?>
                            <div class="gap">
                            <h3><?php esc_html_e('Favorite Shelter', 'catspride'); ?> <span class="required">*</span></h3>
                            <p><?php esc_html_e('Currently, your favorite shelter is:', 'catspride'); ?></p>
                            <a href="<?php echo get_permalink( $favorite_shelter ); ?>"><?php echo $favorite_shelter->post_title; ?></a>
                            <p><?php echo get_field('city', $favorite_shelter_id); ?>
                                , <?php echo get_field('state', $favorite_shelter_id); ?></p>
                            <div class="container clearfix">
                                <a href="<?php echo wc_get_endpoint_url( 'choose-shelter' ); ?>" class="primary-button--blue"><?php esc_html_e('Choose a different shelter', 'catspride'); ?></a>
                            </div>
                            </div>

                        <?php } else { ?>
                            <div class="gap">
                                <h3><?php esc_html_e('Favorite Shelter', 'catspride'); ?> <span class="required">*</span></h3>
                                <p><?php esc_html_e('You have not yet chosen a shelter.', 'catspride'); ?></p>
                                <div class="container clearfix">
                                    <a href="<?php echo wc_get_endpoint_url( 'choose-shelter' ); ?>" class="primary-button--blue"><?php esc_html_e('Choose a shelter', 'catspride'); ?></a>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
<?php /*
            <?php if ( empty( $opted_in ) || $opted_in == '0' ) { ?>
*/ ?>
            <div class=" container section clearfix form-fields">
              <input type="checkbox" style="margin-right:10px;" class="catspride-Input catspride-Input--checkbox input-checkbox" name="allow_marketing_emails" id="allow_marketing_emails" value="1" <?php checked('1', (isset($_POST['allow_marketing_emails']) || $opted_in ? 1 : 0)); ?> />
              <label for="allow_marketing_emails"><?php _e( 'Opt-in to receive marketing emails from Cat\'s Pride', 'catspride' ); ?></label>
            </div>
<?php /*
            <?php } else { ?>

	            <input type="hidden" name="allow_marketing_emails" value="1">

	          <?php } ?>
						*/?>

            <?php do_action( 'woocommerce_edit_account_form' ); ?>

            <hr>
            <div class="section clearfix">
                <div class="container align-center">
                <?php wp_nonce_field( 'save_account_details' ); ?>
                <a style="margin-right:15px;" class="primary-button--purple" href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" title="Return to My Account">Cancel</a>
                <button type="submit" class="woocommerce-Button primary-button--blue" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
                <input type="hidden" name="action" value="save_account_details" />
                </div>
            </div>

            <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
        </form>

        <div class="section clearfix">
        <div class="container"><?php do_action( 'woocommerce_after_edit_account_form' ); ?></div>
        </div>
    </div>
</section>
