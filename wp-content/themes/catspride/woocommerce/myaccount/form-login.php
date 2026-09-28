<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$shelter_registration  = false;
$new_shelter           = false;
$shelter               = false;
$default_county_states = [];

/*
 * Validate shelter token if provided in the URL
 * cp_st = Cat's Pride Shelter Token
 */

$shelter_token = (isset($_GET['cp_st']) && !empty($_GET['cp_st']))
    ? strtolower($_GET['cp_st']) : ((isset($_POST['shelter_token']) && !empty($_POST['shelter_token'])) ? $_POST['shelter_token'] : false);

if ($shelter_token !== false) {

    $shelter = cp_get_shelter_by_token($shelter_token);

    if (! $shelter) {
        wc_add_notice('Invalid shelter token provided. Please try again or contact us for assistance.', 'error');
    }

    $shelter_registration = true;
} else if (isset($_GET['cp_sr'])) {

    // Get states for select population
    $countries_obj = new WC_Countries();
    $countries = $countries_obj->__get('countries');
    $default_country = $countries_obj->get_base_country();
    $default_county_states = $countries_obj->get_states($default_country);

    /*
     * cp_sr = Cat's Pride Shelter Registration
     *
     * This allows a 3rd party to send shelters to a registration form without a shelter token set. This means that
     * the shelter has not yet been added into the system. We will need to display additional fields to request fields
     * that we need information for to make their shelter profile more complete.
     */

    $new_shelter          = true;
    $shelter_registration = true;
}

/*
 * If the user just registered and the cp_verify_sent value is set display a notice
 */
if (isset($_GET['cp_verify_sent'])) {
    wc_add_notice(__('Please check your email for a verification link to complete your registration and activate your account. Don\'t see it? Check your spam folder too!', 'catspride'), 'success');
}

$register_image = get_field('register_image');

if ($shelter_registration === true) {
    $headline = get_field('register_headline_shelter');
    $body     = get_field('register_text_shelter');
} else {
    $headline = get_field('register_headline_user');
    $body     = get_field('register_text_user');
}

/*
 * Setup Tabs
 */
$tab_num_class = 'two-up';

$tabs = [
    'register' => [
        'title' => __('Sign Up', 'catspride')
    ],
    'login' => [
        'title' => __('Login', 'catspride')
    ]
];

$tab_keys      = array_keys($tabs);
$first_tab_key = (isset($_GET['tab']) && in_array($_GET['tab'], $tab_keys))
    ? $_GET['tab'] : ((isset($_POST['login']) && !empty($_POST['login'])) ? 'login' : 'register');

$woocommerce_account_page_id = get_option('woocommerce_myaccount_page_id');
?>

<section class="login-register-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login-left mobile-gutters">
                    <?php $faq_block_title = get_field("faq_block_title",$woocommerce_account_page_id);
                    if ($faq_block_title) : ?>
                        <h1 class="title-primary"><strong><?php echo $faq_block_title; ?></strong></h1>
                    <?php endif; ?>
                    <div class="desktop-accordion">
                        <?php $faq_description = get_field("faq_description", $woocommerce_account_page_id);
                        
                        
                        if ($faq_description) : ?>
                            <p><?php echo $faq_description; ?></p>
                        <?php endif; ?>
                        <div class="faq-wrapper">
                            <div class="container">
                                <div class="faq_row row">
                                    <?php if (have_rows('faq',$woocommerce_account_page_id)): ?>
                                        <div class="accordion">
                                            <?php $accordion_title = get_field("accordion_title",$woocommerce_account_page_id);
                                            if ($accordion_title) : ?>
                                                <h2 class="title-secondary"><?php echo $accordion_title; ?></h2>
                                            <?php endif; ?>
                                            <?php while (have_rows('faq',$woocommerce_account_page_id)): the_row();
                                            ?>
                                                <div class="accordion-item">
                                                    <button class="accordion-header" aria-expanded="false">
                                                        <span class="accordion-icon"><i class="fa-solid fa-chevron-down"></i></span>
                                                        <span class="accordion-title"><?php the_sub_field('faq_title'); ?></span>
                                                    </button>
                                                    <div class="accordion-content">
                                                        <p><?php the_sub_field('faq_answer') ?></p>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="<?php echo $register_image; ?>" alt="<?php echo esc_attr($headline); ?>" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-right">

                    <?php do_action('woocommerce_before_customer_login_form'); ?>

                    <div class="woocommerce-account-login">

                        <?php if (wc_notice_count() > 0) {
                            wc_print_notices();
                        } ?>

                        <?php //ob_start(); 
                        ?>

                        <div class="tab-wrapper">
                            <ul class="tab-menu">
                                <li class="tab-link active" data-tab="signup"><?php _e("Sign Up", "cats-pride") ?></li>
                                <li class="tab-link" data-tab="login"><?php _e("Login", "cats-pride"); ?></li>
                            </ul>

                            <div id="signup" class="tab-content active">
                                <form class="woocommerce-form woocommerce-form-register register" method="post">

                                    <?php do_action('woocommerce_register_form_start'); ?>

                                    <p class="desc">
                                        <?php

                                        if ($shelter !== false || $new_shelter !== false) {

                                            if ($new_shelter !== false) { ?>

                                                <strong>
                                                    <?php esc_html_e('Want to receive donated litter for your shelter? Register for the Cat\'s Pride Litter for Good program here.', 'catspride'); ?>
                                                </strong><br /><br />
                                        <?php
                                            }
                                        } else {
                                            esc_html_e('Join the Cat\'s Pride Club to receive emails with special coupons and cat tips, to nominate your favorite shelter for free litter, and more!', 'catspride');
                                        }

                                        ?>
                                    </p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="first_name"><?php esc_html_e('First Name', 'woocommerce'); ?> <span class="required">*</span></label>
                                            <input required="required" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="first_name" value="<?php echo (! empty($_POST['first_name'])) ? esc_attr($_POST['first_name']) : ''; ?>" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="last_name"><?php esc_html_e('Last Name', 'woocommerce'); ?> <span class="required">*</span></label>
                                            <input required="required" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="last_name" value="<?php echo (! empty($_POST['last_name'])) ? esc_attr($_POST['last_name']) : ''; ?>" />
                                        </div>
                                    </div>

                                    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo (! empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>" />
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?> <span class="required">*</span></label>
                                            <input required="required" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo (((! empty($_POST['email'])) ? esc_attr($_POST['email']) : (isset($_GET['username']) && ! empty($_GET['username']) ? esc_attr($_GET['username']) : (isset($_GET['email']) && ! empty($_GET['email']) ? esc_attr($_GET['email']) : '')))); ?>" />
                                        </div>
                                    </div>

                                    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                                        <div class="row">
                                            <div class="col-12">

                                                <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
                                                <input required="required" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($new_shelter === true) { ?>

                                        <h4><?php esc_html_e('Shelter Basic Information', 'catspride'); ?></h4>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="shelter_name"><?php esc_html_e('Shelter\'s Name', 'catspride'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_name" id="shelter_name" value="<?php echo (! empty($_POST['shelter_name'])) ? esc_attr($_POST['shelter_name']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="shelter_ein"><?php esc_html_e('Shelter EIN', 'catspride'); ?> <span class="required">*</span>
                                                    <br><span style="font-size:12px;">(Employer Identification Number, a 9-digit number assigned by the IRS)</span>
                                                </label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_ein" id="shelter_ein" value="<?php echo (! empty($_POST['shelter_ein'])) ? esc_attr($_POST['shelter_ein']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <label for="shelter_address_1"><?php esc_html_e('Shelter Address', 'catspride'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_address_1" id="shelter_address_1" value="<?php echo (! empty($_POST['shelter_address_1'])) ? esc_attr($_POST['shelter_address_1']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="shelter_address_2"><?php esc_html_e('Address 2', 'catspride'); ?></label>
                                                <input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_address_2" id="shelter_address_2" value="<?php echo (! empty($_POST['shelter_address_2'])) ? esc_attr($_POST['shelter_address_2']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <label for="shelter_city"><?php esc_html_e('City', 'catspride'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_city" id="shelter_city" value="<?php echo (! empty($_POST['shelter_city'])) ? esc_attr($_POST['shelter_city']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="shelter_state"><?php esc_html_e('State', 'catspride'); ?> <span class="required">*</span></label>
                                                <select required="required" class="catspride-Input catspride-Input--select input-select" name="shelter_state" id="shelter_state">
                                                    <?php foreach ($default_county_states as $state_abbr => $state) { ?>
                                                        <option value="<?php echo $state_abbr; ?>" <?php selected((! empty($_POST['shelter_state'])) ? esc_attr($_POST['shelter_state']) : '', $state_abbr) ?>><?php echo $state_abbr ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-9">
                                                <label for="shelter_zip_code"><?php esc_html_e('Zip Code', 'catspride'); ?> <span class="required">*</span></label>
                                                <input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_zip_code" id="shelter_zip_code" value="<?php echo (! empty($_POST['shelter_zip_code'])) ? esc_attr($_POST['shelter_zip_code']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <h4><?php esc_html_e('Shelter Contact Information', 'catspride'); ?></h4>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="shelter_phone"><?php esc_html_e('Phone Number', 'catspride'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_phone" id="shelter_phone" value="<?php echo (! empty($_POST['shelter_phone'])) ? esc_attr($_POST['shelter_phone']) : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <label for="shelter_website"><?php esc_html_e('Website', 'catspride'); ?> <span class="required">*</span></label>
                                                <input required="required" type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_website" id="shelter_website" value="<?php echo (! empty($_POST['shelter_website'])) ? esc_attr($_POST['shelter_website']) : ''; ?>" placeholder="http://" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <input type="checkbox" class="woocommerce-Input woocommerce-Input--checkbox input-checkbox" name="reg_litter_for_good" id="reg_litter_for_good" value="1" <?php checked('1', (isset($_POST['reg_litter_for_good']) ? 1 : 0)); ?> />
                                                <label for="reg_litter_for_good">
                                                    By registering with the Cat's Pride Litter for Good program, I grant permission to Cat's Pride to use, display, or publish my shelter's name, photos, and/or logo, and agree to receive emails from Cat's Pride. I acknowledge that cat litter donations from Cat's Pride through the Litter for Good program can be made in the form of coupons and that I am responsible for picking up or paying for shipping of the donated litter.
                                                </label>
                                            </div>

                                        </div>

                                    <?php } ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="checkbox-wrapper">
                                                <input type="checkbox" class="woocommerce-Input woocommerce-Input--checkbox input-checkbox" name="allow_marketing_emails" id="reg_marketing_emails" value="1" <?php checked('1', (isset($_POST['allow_marketing_emails']) ? 1 : 0)); ?> />
                                                <label for="reg_marketing_emails">
                                                    <?php echo sprintf(__('By entering my email address, I agree to receive emails from Cat\'s Pride and Oil-Dri Corporation. Collected information will not be shared with any third party and complies with Cat\'s Pride\'s 
                                            <a href="%s" title="Privacy Policy" target="_blank">Privacy Statement</a>.', 'catspride'), get_permalink(get_page_by_path('privacy-statement'))); ?>
                                                </label>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="checkbox-wrapper">
                                                <input required="required" type="checkbox" class="woocommerce-Input woocommerce-Input--checkbox input-checkbox" name="terms_conditions" id="reg_terms_conditions" value="1" <?php checked('1', (isset($_POST['terms_conditions']) ? 1 : 0)); ?> />
                                                <label for="reg_terms_conditions">
                                                    <?php echo sprintf(__('I agree to the <a href="%s" title="Terms and Conditions" target="_blank">terms and conditions</a>.', 'catspride'), get_permalink(get_page_by_path('legal'))); ?>
                                                </label>
                                            </div>

                                        </div>

                                    </div>

                                    <?php do_action('woocommerce_register_form'); ?>

                                    <div class="row">
                                        <div class="col-12">

                                            <?php if ($shelter !== false) { ?>
                                                <input type="hidden" value="<?php echo $shelter_token; ?>" name="shelter_token" />
                                            <?php } ?>
                                            <?php if ($new_shelter !== false) { ?>
                                                <input type="hidden" value="1" name="new_shelter" />
                                            <?php } ?>
                                            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                            <button type="submit" class="woocommerce-Button primary-button--blue" name="register" value="<?php esc_attr_e('Sign Up', 'catspride'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                                        </div>
                                    </div>

                                    <?php do_action('woocommerce_register_form_end'); ?>

                                    <p class="tab-toggle-click-wrapper"><?php esc_html_e('Already a member?', 'catspride'); ?> <a href="#tab-2" class="tab-toggle-click" data-cs-tab-toggle="2"><?php esc_html_e('Log In', 'catspride'); ?></a></p>

                                </form>
                            </div>

                            <div id="login" class="tab-content">
                                <form class="woocommerce-form woocommerce-form-login login" method="post">

                                    <?php do_action('woocommerce_login_form_start'); ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?> <span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
                                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                                        </div>
                                    </div>

                                    <?php do_action('woocommerce_login_form'); ?>

                                    <div class="row">
                                        <div class="col-12">                                            <?php if (isset($_GET['shelter'])) { ?>
                                                <input type="hidden" name="shelter_login" value="1" />
                                            <?php } ?>
                                            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                            <button type="submit" class="woocommerce-Button primary-button--blue" name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></button>
    
                                            <div class="checkbox-wrapper login-checkbox-wrapper">
                                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                                    <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row woocommerce-LostPassword lost_password">
                                        <div class="col-12">
                                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
                                        </div>
                                    </div>

                                    <?php if (isset($_GET['shelter_login'])) { ?>
                                        <p>
                                            <?php esc_html_e('Not a registered shelter?'); ?>
                                            <a href="<?php echo get_permalink('contact-us'); ?>" title="Contact Us" target="_blank"><?php esc_html_e('Contact Us', 'catspride'); ?></a>
                                        </p>
                                    <?php } ?>

                                    <?php do_action('woocommerce_login_form_end'); ?>

                                </form>
                            </div>
                        </div>
                        <?php do_action('woocommerce_after_customer_login_form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>