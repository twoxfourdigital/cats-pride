<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$user_id             = $current_user->ID;
$user_details        = get_userdata($user_id);
$user_created_year   = date('Y', strtotime(get_userdata($user_id)->user_registered));
$cats                = get_user_meta($user_id, 'pet_information', true);
$is_shelter_manager  = in_array('shelter_manager', $user_details->roles);
$manage_shelter_id   = false;

// Does this user have a shelter transfer request pending to them?
$transfer_request = cp_get_shelter_transfer_request_to_user_by_id($user_id);

// Profile Data
$firstname  = $user_details->first_name;
$lastname   = $user_details->last_name;
$birthdate  = get_user_meta($user_id, 'birthdate', true);
$gender     = get_user_meta($user_id, 'gender', true);
$plt        = get_user_meta($user_id, 'preferred_litter_type', true);
$ppo        = get_user_meta($user_id, 'preferred_purchase_outlet', true);

// Retrieve the user's favorite/nominated shelter
$nomination          = cp_get_current_shelter_nomination_for_user($user_id);
$favorite_shelter_id = ($nomination) ? $nomination->shelter_post_id : null;
$favorite_shelter    = ($favorite_shelter_id) ? get_post($favorite_shelter_id) : false;

// Retrieve cat's that have already been set by the user
$cats = isset($_POST['pet_information']) ? $_POST['pet_information'] : get_user_meta($user_id, 'pet_information', true);

// Set the preferred litter types
$litters    = cp_get_preferred_litter_types();
// Ensure they are assigned a shelter
if ($is_shelter_manager === true) {
    $manage_shelter_id = cp_get_shelter_by_manager_id($user_id);
}

// Retrieve bonus code details if the user has one applied to their account
$bonus_code     = ($nomination && isset($nomination->bonus_code) && !empty($nomination->bonus_code)) ? $nomination->bonus_code : false;
$bonus_multiple = ($nomination && isset($nomination->bonus_multiple) && !empty($nomination->bonus_multiple)) ? $nomination->bonus_multiple : false;
$has_bonus_code = ($bonus_code) ? true : false;

?>

<div class="hero-banner" style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/assets/images/member-dashboard-hero.jpg'); ?>)">
    <div class="hero-banner__wrapper container">
        <div class="hero-banner__inner row">
            <div class="hero-banner__left col-md-6">
                <h1 class="title-primary">
                    <?php if ($current_user->user_firstname) : ?>
                        <span><?php printf(__('HELLO, %1$s', 'woocommerce'), '<strong>' . esc_html($current_user->user_firstname) . '</strong>'); ?></span>
                    <?php else : ?>
                        <span><?php printf(__('HELLO, %1$s', 'woocommerce'), '<strong>' . esc_html($current_user->display_name) . '</strong>'); ?></span>
                    <?php endif; ?>
                </h1>
                <h4 class="title-hero"><span><?php printf(__('Cat\'s Pride Club Member since %1$d', 'catspride'), $user_created_year) ?></span></h2>

                    <div class="account-box-wrapper">
                        <p>
                            <i class="fa-solid fa-pencil"></i>

                            <a href="<?php echo wc_get_account_endpoint_url('edit-account'); ?>"><?php _e('Edit profile', 'catspride'); ?></a>

                            <?php if ($is_shelter_manager === true && $manage_shelter_id !== false) { ?>
                                <span> | </span>
                                <a href="<?php echo wc_get_account_endpoint_url('shelter-resources'); ?>"><?php _e('Manage shelter', 'catspride'); ?></a>
                            <?php } else { ?>
                        <ul>
                            <li><?php _e("Add your pets", "cats-pride"); ?></li>
                            <li><?php _e("Confirm your litter preferences", "cats-pride"); ?></li>
                            <li><?php _e("Nominate your favorite shelter for litter donations", "cats-pride"); ?></li>
                        </ul>
                    <?php } ?>
                    </p>
                    </div>
            </div>
        </div>
    </div>
</div>


<?php if (wc_notice_count() > 0) { ?>

    <section class="woocommerce-notice">
        <div class="container">
            <?php wc_print_notices(); ?>
        </div>
    </section>

<?php } ?>

<?php if ($transfer_request !== false) { ?>

    <?php $transfer_shelter = $transfer_request['shelter'] ?>
    <section class="shelter-wrapper">
        <div class="container">
            <div class="shelter-wrapper__inner">
                <h2 class="title-secondary">
                    <?php _e('Shelter Manager <strong>Transfer Request</strong>', 'cats-pride'); ?>
                </h2>
                <form class="catspride-TransferShelterResponseForm transfer-shelter-response disable-on-submit" method="post">

                    <div class="shelter-inner-box">
                        <p><?php echo sprintf(
                                __('The shelter manager "%s" has requested that you become the new shelter manager for <strong>%s</strong>. By accepting this request, your account will convert to a shelter manager profile, granting you the ability to manage details regarding the shelter.', 'catspride'),
                                $transfer_request['transfer_from_user']->user_email,
                                $transfer_request['shelter']->post_title
                            ); ?></p>
                    </div>

                    <div class="shelter-inner-box">
                        <input type="checkbox" class="woocommerce-Input woocommerce-Input--checkbox input-checkbox" name="allow_marketing_emails" id="reg_marketing_emails" value="1" <?php checked('1', (isset($_POST['allow_marketing_emails']) ? 1 : 0)); ?> />
                        <label for="reg_marketing_emails">
                            <?php echo sprintf(__('By entering my email address, I agree to receive emails from Cat\'s Pride and Oil-Dri Corporation. Collected information will not be shared with any third party and complies with Cat\'s Pride\'s 
                        <a href="%s" title="Privacy Policy" target="_blank">Privacy Statement</a>.', 'catspride'), get_permalink(get_page_by_path('privacy-statement'))); ?>
                        </label>
                    </div>

                    <div class="shelter-inner-box">
                        <input type="checkbox" class="woocommerce-Input woocommerce-Input--checkbox input-checkbox" name="terms_conditions" id="reg_terms_conditions" value="1" <?php checked('1', (isset($_POST['terms_conditions']) ? 1 : 0)); ?> />
                        <label for="reg_terms_conditions">
                            <?php echo sprintf(__('I agree to the <a href="%s" title="Terms and Conditions" target="_blank">terms and conditions</a>.', 'catspride'), get_permalink(get_page_by_path('legal'))); ?>
                        </label>
                    </div>

                    <?php wp_nonce_field('catspride-transfer_shelter_response'); ?>
                    <input type="hidden" name="button_action" value="transfer_shelter_response" />
                    <input type="hidden" name="action" value="transfer_shelter_response" />
                    <input type="submit" class="catspride-Button button save_to_button_action primary-button" name="transfer_shelter_accept" value="<?php esc_attr_e('I Accept', 'catspride'); ?>">
                    <input type="submit" class="catspride-Button button save_to_button_action primary-button" name="transfer_shelter_decline" value="<?php esc_attr_e('No, Thanks', 'catspride'); ?>">
                </form>
            </div>
        </div>
    </section>


<?php } ?>


<section class="nominate-shelter-wrapper">
    <div class="container">
        <div class="nominate-shelter__inner">
            <h3 class="title-third">
                <strong>
                    <?php _e("Nominate Your Favorite Shelter", "cats-pride"); ?>
                </strong>
            </h3>
            <p>
                Nominate your favorite animal welfare organization to be eligible to receive litter donations.
                The more nominations an organization receives,
                the more litter that is donated to them. So
                <a class="underline" href="https://www.facebook.com/sharer.php?u=https://catspride.com/litterforgood/&t=join" onclick="window.open('https://www.facebook.com/sharer.php?u=https://catspride.com/litterforgood/&t=Join Litter for Good to help more shelter cats!', 'popupFacebook', 'width=650, height=270, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
                    invite your supporters, family and friends
                </a>
                to join the Cat's Pride Club and nominate their
                favorite shelter today.
            </p>

        </div>

        <div class="nominate-shelter-banner">
            <div class="row">
                <div class="nominate-shelter__left">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/CATS_PRIDE_DAN_SHELTER.jpg">
                </div>
                <div class="nominate-shelter__right">

                    <div class="nominate-shelter__right-inner" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/purple-fabric-background.jpg)">

                        <?php if ($favorite_shelter) { ?>

                            <h2 class="title-third"><span><?php _e('Your Favorite Shelter', 'cats-pride'); ?></span></h2>
                            <div class="shelter-description">
                                <p><?php _e('Currently, your favorite shelter is:', 'cats-pride'); ?><br />
                                    <strong>
                                        <span><?php echo $favorite_shelter->post_title; ?>
                                            <?php if ($has_bonus_code) { ?>
                                                <span class="cp-bonus-code-tag cp-bonus-code-tag-multiple-<?php echo $bonus_multiple; ?>"><?php echo $bonus_multiple; ?>X Bonus</span>
                                            <?php } ?>
                                        </span>
                                    </strong><br />
                                    <?php echo get_field('city', $favorite_shelter_id); ?>, <?php echo get_field('state', $favorite_shelter_id); ?>
                                </p>

                                <a class="primary-button primary-button--white" href="<?php echo wc_get_endpoint_url('choose-shelter'); ?>" data-options="thumbnail: ''" style="outline: medium none currentcolor;"><?php _e('Nominate', 'catspride'); ?></a>

                                <?php if (get_field('shelter_bonus_code_entry', 'option')) { ?>

                                    <div class="cp-bonus-wrapper">
                                        <span class="cp-bonus-code-prompt cp-bonus-code-off">
                                            <?php _e("Have a bonus code?", "cats-pride"); ?>
                                        </span>
                                        <form id="catspride-ShelterBonusCodeForm" class="catspride-ShelterBonusCodeForm shelter-bonus-code cp-form cp-bonus-code-on" method="post">
                                            <div class="left-form-wrapper">
                                                <input class="catspride-ShelterBonusCode-bonus_code cp-form-input" type="text" name="bonus_code" value="" placeholder="Enter Bonus Code" />
                                                <input id="input-shelter-bonus-code-favorite_shelter" type="hidden" name="favorite_shelter" value="<?php echo $favorite_shelter_id; ?>" />
                                                <input id="input-shelter-bonus-code-action" type="hidden" name="action" value="shelter_bonus_code" />
                                                <?php wp_nonce_field('catspride-shelter_bonus_code'); ?>
                                            </div>
                                            <div class="right-form-wrapper">
                                                <button class="x-btn purple-rev x-btn-global primary-button primary-button--white" type="submit" data-options="thumbnail: ''" style="outline: medium none currentcolor;"><?php _e('Submit', 'catspride'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>

                            </div>

                        <?php } else { ?>

                            <h2 class="title-third">
                                <span><?php _e('Nominate your favorite shelter today!', 'cats-pride'); ?></span>
                            </h2>
                            <div class="shelter-description">
                                <p>
                                    <?php _e(
                                        'Your nomination helps your favorite shelter receive even more litter donations.',
                                        'catspride'
                                    );
                                    ?>
                                </p>
                                <a class="primary-button primary-button--white" href="<?php echo wc_get_endpoint_url('choose-shelter'); ?>" data-options="thumbnail: ''" style="outline: medium none currentcolor;"><?php _e('Nominate', 'catspride'); ?></a>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<?php if ($cats && count($cats) > 0) { ?>

    <section class="cat-info-wrapper">
        <div class="container">
            <div class="cat-info__inner cat-info__inner-title">
                <h2 class="title-secondary"><span><?php _e(sprintf('Your <strong>%s</strong>', (count($cats) > 1) ? 'Cats' : 'Cat'), 'catspride'); ?></span></h2>
            </div>

            <div class="cat-info__inner">

                <?php foreach ($cats as $cat) { ?>

                    <div class="cp-my-account-cat-wrapper">
                        <img class="caticon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/CatilloIcon.png" />
                        <div class="cat-inner-description">
                            <h4><?php echo $cat['name']; ?></h4>
                            <?php _e('Adoption Date', 'catspride'); ?>: <span class="cp-cat-date"><?php echo date('M d, Y', strtotime($cat['date'])); ?></span>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>


<?php } ?>

<section class="account-coupon-wrapper">

    <div class="container">
        <h2 class="title-secondary">
            <span><?php _e('Your <strong>Coupons</strong>', 'cats-pride'); ?>
        </h2>

        <div class="account-coupon__inner">
            <div class="row">
                <?php if (!empty($firstname) && !empty($lastname) && ($cats && count($cats) > 0) && $favorite_shelter !== false) { ?>
                    <div class="col-md-6">
                        <?php /*
                        <div id="cp_revtrax" style="width:100%;" scrolling="no" allowtransparency="yes"></div>

                        <script src="https://irxcm.com/RevTrax/js/rtxiframe.jsp?parent=cp_revtrax&rtxuseqs=true&merchantId=89088647&programId=105617631&affiliateId=89091525&channel=brand"></script>
                        <script>makeFrame();</script>

                        <script src="https://images.revtrax.com/RevTrax/js/libs/iframeresizer.js"></script>
                        <script>iFrameResize({checkOrigin: false});</script>
                        */
                        ?>
                        <div>
                            <!-- <script id="propodEmbedc8b5746dc32edcaee01009041f9679083f39ea8c" src="https://banner2.promotionpod.com/frames/c8b5746dc32edcaee01009041f9679083f39ea8c.js"></script> -->
                            <script id="propodEmbed4fce476720cd4f598e34ff12ea7fc97f" src=https://banner2.promotionpod.com/frames/4fce476720cd4f598e34ff12ea7fc97f.js></script>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12">
                        <p>
                            <?php
                            printf(
                                __('<a href="%s" title="Complete Your Profile"><strong>Complete your profile</strong></a> to get exclusive rewards from Cat\'s Pride! You\'ll get coupons for discounts, rewards on your birthday and your cat\'s adoption day, and more.', 'cats-pride'),
                                wc_get_account_endpoint_url('edit-account')
                            );
                            ?>
                        </p>
                    </div>
                <?php } ?>
            </div>

        </div>

    </div>
</section>


<!-- <div class="x-container max width marginless-columns" style="margin: 0px auto;padding: 40px 0px 0px;">
    <div class="x-column x-sm x-1-1 mobile-pan">
        <img class="x-img man x-img-none" src="<?php // echo content_url(); 
                                                ?>/uploads/2017/12/Cats-Pride-2-CPCProfile_CAT_1648.jpg" />
    </div>
</div> -->


<section class="video-text-wrapper">
    <div class="container">
        <div class="video-text-wrapper__inner">
            <div class="video-text-wrapper__item video-text-wrapper__item-green">
                <h3 class="title-third">
                    <?php echo "Helping shelter cats find forever homes, 
                <strong>one jug of litter at a time.</strong>" ?>
                </h3>
                <a class="primary-button--white-blue" href="/litterforgood" data-options="thumbnail: ''">Learn More</a>

            </div>
            <div class="video-text-wrapper__item">
                <a class="x-img man lity-link" href="https://www.youtube.com/watch?v=FtXGZzFgKlQ" data-lity data-lity-options="{ 'autoplay': true }">
                    <img src="https://catspride.com/wp-content/uploads/2020/11/charlene-banner-video.jpg" alt="Play Video">
                </a>

                <div id="share-video">
                    <div class="catspride">
                        <div class="cp-entry-share">
                            <p>Watch &amp; share this video:</p>
                            <div class="cp-share-options">
                                <a href="#share" class="cp-share" title="Share on Facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=https://www.youtube.com/watch?v=FtXGZzFgKlQ&amp;t=Join Litter for Good to help more shelter cats!', 'popupFacebook', 'width=650, height=270, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
                                    <i class="fa-brands fa-square-facebook" style="color: #ffffff; font-size: 24px"></i>
                                </a>
                                <a href="#share" class="cp-share" title="Share on Twitter" onclick="window.open('https://twitter.com/intent/tweet?text=Join Litter for Good to help more shelter cats!&amp;url=https://www.youtube.com/watch?v=FtXGZzFgKlQ', 'popupTwitter', 'width=500, height=370, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
                                    <i class="fa-brands fa-square-twitter" style="color: #ffffff; font-size: 24px"></i>
                                </a>
                                <a href="#share" class="cp-share" title="Share on Pinterest" onclick="window.open('http://pinterest.com/pin/create/button/?url=https://www.youtube.com/watch?v=FtXGZzFgKlQ&amp;media=https%3A%2F%2Fcatspride.com%2Fwp-content%2Fuploads%2F2019%2F09%2FCats-Pride-Logo-social-2019.png&amp;description=Join Litter for Good to help more shelter cats!', 'popupPinterest', 'width=750, height=265, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
                                    <i class="fa-brands fa-square-pinterest" style="color: #ffffff; font-size: 24px"></i>
                                </a>
                                <a href="#share" class="cp-share email friend-share-trigger" title="Share via Email">
                                    <i class="fa-solid fa-square-envelope" style="color: #ffffff; font-size: 24px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="friend-share-wrapper">
    <div class="container">
        <div class="friend-share__inner">
            <?php echo do_shortcode('[cp_friend_share headline="Email a Friend" description="Enter the email address of you and a friend and we will let them know how to check-out our video above!"]'); ?>
        </div>
    </div>
</section>


<section class="litter-for-good-wrapper">
    <div class="container">
        <h2 class="title-secondary"><strong><?php _e("Litter for Good", "cats-pride"); ?></strong></h2>
        <p>
            <?php _e("For every jug of Cat's Pride litter purchased, we donate a pound of litter to an animal welfare organization. The Litter for Good program is a part of our ongoing commitment to improving the lives of cats and their people.", "cats-pride"); ?>
        </p>
    </div>
</section>

<section class="pounds-to-donate-wrapper">
    <div class="container">
        <?php echo do_shortcode('[cp_lfg_litter_donated]'); ?>
    </div>
</section>
