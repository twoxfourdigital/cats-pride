<?php

get_header();

global $post;

// Populate values
$shelter_name      = $post->post_title;
$shelter_ein       = get_field('ein', $post->ID);
$shelter_address_1 = get_field('address_1', $post->ID);
$shelter_address_2 = get_field('address_2', $post->ID);
$shelter_city      = get_field('city', $post->ID);
$shelter_state     = get_field('state', $post->ID);
$shelter_zip_code  = get_field('zip_code', $post->ID);

$address_formatted = '';

if (! empty($shelter_address_1)) {
    $address_formatted .= $shelter_address_1;
}
if (! empty($shelter_address_2)) {
    if (!empty($address_formatted)) {
        $address_formatted .= '<br>';
    }
    $address_formatted .= $shelter_address_2;
}
if (! empty($address_formatted)) {
    $address_formatted .= '<br>' . $shelter_city . ', ' . $shelter_state . ' ' . $shelter_zip_code;
}

$shelter_contact   = get_field('contact', $post->ID);
$shelter_phone     = get_field('phone', $post->ID);
$shelter_email     = get_field('email', $post->ID);
$shelter_website   = get_field('website', $post->ID);
$shelter_facebook  = get_field('facebook', $post->ID);
$shelter_twitter   = get_field('twitter', $post->ID);
$shelter_youtube   = get_field('youtube ', $post->ID);
$shelter_instagram = get_field('instagram', $post->ID);

$nomination_count      = cp_get_shelter_nomination_count($post->ID);
$shelter_creation_date = $post->post_date;
$since_date = ($post->post_date >= '2018-01-01') ? date('F Y', strtotime($shelter_creation_date)) : 'January 2018';

$shelter_page_header_type   = get_field('page_header_type', $post->ID);
$shelter_page_header_video  = get_field('page_header_video', $post->ID);
$shelter_page_header_slides = get_field('page_header_slideshow', $post->ID);
$shelter_page_visibility    = get_field('page_visible', $post->ID);

// Default to visible
$shelter_page_visibility = ($shelter_page_visibility === 0 || $shelter_page_visibility === false) ? false : true;

// Default to visible
$shelter_contact_name_visibility  = get_field('contact_name_visible', $post->ID);
$shelter_contact_name_visibility  = ($shelter_contact_name_visibility === 1 || $shelter_contact_name_visibility === true) ? true : false;
$shelter_phone_visibility         = get_field('phone_visible', $post->ID);
$shelter_phone_visibility         = ($shelter_phone_visibility === 1 || $shelter_phone_visibility === true) ? true : false;
$shelter_email_visibility         = get_field('email_visible', $post->ID);
$shelter_email_visibility         = ($shelter_email_visibility === 1 || $shelter_email_visibility === true) ? true : false;

// Default to not-visible
$shelter_address_visibility       = get_field('address_visible', $post->ID);
$shelter_address_visibility       = ($shelter_address_visibility === 0 || $shelter_address_visibility === false) ? false : true;
$shelter_website_visibility       = get_field('website_visible', $post->ID);
$shelter_website_visibility       = ($shelter_website_visibility === 0 || $shelter_website_visibility === false) ? false : true;
$shelter_facebook_visibility      = get_field('facebook_visible', $post->ID);
$shelter_facebook_visibility      = ($shelter_facebook_visibility === 0 || $shelter_facebook_visibility === false) ? false : true;
$shelter_instagram_visibility     = get_field('instagram_visible', $post->ID);
$shelter_instagram_visibility     = ($shelter_instagram_visibility === 0 || $shelter_instagram_visibility === false) ? false : true;
$shelter_twitter_visibility       = get_field('twitter_visible', $post->ID);
$shelter_twitter_visibility       = ($shelter_twitter_visibility === 0 || $shelter_twitter_visibility === false) ? false : true;

$upload_path_url = wp_upload_dir();
$upload_path_url = $upload_path_url['baseurl'] . '/cp_shelter_uploads/';
$attachments = get_post_meta($post->ID, 'slideshow_attachments', true);
$attachments = ($attachments) ? $attachments : [];

$resources_page_id = get_page_by_path('member-dashboard')->ID;

$shelter_page_url  = get_permalink($post->ID);

$is_shelter_manager = false;

if (is_user_logged_in()) {
    $is_shelter_manager = (get_current_user_id() === cp_get_shelter_manager_id($post->ID)) ? true : false;
}

?>

<div class="full page-template-template-blank public-shelter-page shelter public shelter-public" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <?php $our_mission = get_the_content(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">

                <?php if ($shelter_page_visibility === false && $is_shelter_manager === false && ! current_user_can('manage_options')) { ?>

                    <div class="section">

                        <div class="container">

                          <div class="e3534-3 x-column x-sm x-1-1"
                                style="height: 100vh; display: flex; flex-direction: column; padding-top: 150px;">
                            <h1 class="h-custom-headline cs-ta-center h1" style="color: #2f408e;">
                                <span>We're <strong>sorry!</strong></span>
                            </h1>
                            <hr class="e3534-5 x-line">
                            <div class="x-text cs-ta-center" style="font-size:2em;">
                                <p>This shelter's public profile is not currently available.</p>
                            </div>
                            </div>


                        </div>

                    </div>

                <?php } else { ?>

                    <div id="cs-content" class="cs-content">

                        <section class="single-shelter-hero-section">
                            <div class="container">
                                <div class="single-shelter-hero__inner">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="headline">
                                                <p><?php _e("Litter for Good Program", "catspride"); ?></p>
                                                <h1><strong><?php the_title(); ?>!</strong></h1>
                                                <h2><?php echo $shelter_city . ', ' . $shelter_state . ' ' . $shelter_zip_code; ?></h2>
                                            </div>

                                            <div class="cp-shelter-nomination-wrapper cp-shelter-public-nomination-wrapper">
                                                <h3><?php _e("Help us get <strong>more donated litter</strong>", "catspride"); ?></h3>
                                                <p><?php _e("Each nomination means more litter for our shelter.", "catspride"); ?></p>
                                                <?php if (is_user_logged_in()) { ?>
                                                    <form method="POST">
                                                        <?php wp_nonce_field('catspride-choose_shelter') ?>
                                                        <input type="hidden" name="favorite_shelter" value="<?php echo $post->ID; ?>" />
                                                        <input type="hidden" name="action" value="choose_shelter" />
                                                        <button class="x-btn blue-rev pll prl mtn mbs mln mobile-mbm x-btn-global primary-button--white-blue" type="submit"><?php _e("Nominate us", "catspride"); ?></button>
                                                    </form>
                                                <?php } else { ?>
                                                    <a class="x-btn blue-rev pll prl mtn mbs mln mobile-mbm x-btn-global primary-button--white-blue" href="<?php echo esc_attr(wc_get_page_permalink('myaccount')); ?>" title="Nominate Us"><?php _e("Nominate us", "catspride"); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php if ($shelter_page_header_type === 'video' && ! empty($shelter_page_header_video)) { ?>

                                                <div id="shelter-video" class="shelter-media-holder video-holder" style="">
                                                    <?php echo cp_convert_youtube_url_to_embed($shelter_page_header_video, $video_height = 325); ?>
                                                </div>

                                            <?php } else if ($shelter_page_header_type === 'slideshow' && count($attachments) > 0) { ?>

                                                <div id="shelter-slideshow" class="shelter-media-holder slideshow-holder" style="">

                                                    <?php if (count($attachments) > 0) { ?>

                                                        <div class="shelter-slider">
                                                         <?php
                                                        foreach ($attachments as $attachment) {
                                                            ?> <div class="single-slide"><img src="<?php echo $upload_path_url . esc_attr($attachment); ?>" class="cp-shelter-page-attachment" /></div> <?php 
                                                        }

                                                        // $slider = '[slider animation="slide" slide_time="5000" slide_speed="600" slideshow="true" random="false" control_nav="true" prev_next_nav="false" no_container="true"]';

                                                        // foreach ($attachments as $attachment) {
                                                        //     $slider .= '[slide]<img src="' . $upload_path_url . esc_attr($attachment) . '" class="cp-shelter-page-attachment" />[/slide]';
                                                        // }

                                                        // $slider .= '[/slider]';

                                                        // echo do_shortcode($slider);
                                                        ?>
                                                        </div>
                                                        <?php 
                                                    } ?>

                                                </div>

                                            <?php } else { ?>

                                                <div id="shelter-image" class="shelter-media-holder image-holder" style="">

                                                    <img src="<?php esc_attr_e(get_field('header_image', $resources_page_id)); ?>" />

                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="single-shelter-donation-section">
                            <div class="container">
                                <div class="donation-top-wrapper">
                                    <div class="row">
                                        <?php if ($shelter_page_visibility === false && ($is_shelter_manager === true || current_user_can('manage_options'))) { ?>
                                            <h4><?php _e("Please Note: This page is not currently viewable to the public.", "catspride"); ?></h4>
                                        <?php } ?>
                                        <div class="col-sm-6">
                                            <h3><?php _e("You buy a jug. <strong>We donate a pound.</strong>", "catspride"); ?></h3>
                                            <p><?php _e("Every time you buy a jug of Cat's Pride litter, Cat's Pride donates a pound of litter to shelters in need so we can focus our resources on saving shelter cats.", "catspride"); ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="icon-holder">
                                                <img src="<?php echo content_url(); ?>/themes/catspride/assets/images/LFG_Short_Logo-v4.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="donation-bottom-wrapper">
                                    <div class="row">
                                        <div class="col-sm-4 left-donation-wrapper">
                                            <div class="left-donation-wrapper__inner">
                                                <p class="cp-nomination-count"><?php echo $nomination_count; ?></p>
                                                <h3 class="cp-nomination-title"><?php _e("Nominations", "catspride"); ?></h3>
                                                <p class="cp-nomination-since">
                                                    Since <?php echo $since_date; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 right-donation-wrapper">
                                            <h3><?php _e("Help us get <strong>more nominations</strong>", "catspride"); ?></h3>
                                            <div class="right-donation-wrapper__inner">
                                                <p><?php _e("Invite your friends and family to nominate our shelter. Share this page across social using the below icons.", "catspride"); ?></p>
                                                <p>Share on <span><a
                                                            href="https://www.facebook.com/sharer.php?u=<?php echo esc_attr($shelter_page_url); ?>" class="facebook"
                                                            title="Facebook" target="_blank"
                                                            rel="noopener noreferrer"><i class="fa-brands fa-square-facebook" style="color: #fff"></i></a><a
                                                            href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($shelter_page_url); ?>&text=<?php echo esc_attr($shelter_name); ?>&via=catspride" class="twitter"
                                                            title="Twitter" target="_blank" rel="noopener noreferrer">
                                                            <i class="fa-brands fa-square-twitter" style="color: #fff"></i></a></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div id="content">
                            <!-- <div class="x-container max width marginless-columns" style="margin: 50px auto 0px;padding: 0px;"> -->
                            <!-- <div class="x-column x-sm cs-ta-center white x-1-1" style="padding: 0px;"> -->
                            <?php /*
                                        <div id="cp_revtrax" style="width:100%;" scrolling="no" allowtransparency="yes"></div>

                                        <script src="https://irxcm.com/RevTrax/js/rtxiframe.jsp?parent=cp_revtrax&rtxuseqs=true&merchantId=89088647&programId=105617898&affiliateId=89091525&channel=brand"></script>
                                        <script>makeFrame();</script>

                                        <script src="https://images.revtrax.com/RevTrax/js/libs/iframeresizer.js"></script>
                                        <script>iFrameResize({checkOrigin: false});</script>

                                        <!-- <a href="http://qupon.ws/rd/4LGQLJ" target="_blank">
                                            <img class="x-img top x-img-none"
                                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/UpdatedCouponBannerCM.png">
                                        </a> -->
                                        */
                            ?>
                            <!-- <div align="center">
                                            <script id="propodEmbedc5107a3ac27b5c8f56456d862db8af49daebfa7b" src="https://banner2.promotionpod.com/frames/c5107a3ac27b5c8f56456d862db8af49daebfa7b.js"></script>
                                        </div> -->
                            <!-- </div> -->
                            <!-- </div> -->

                        </div>

                        <section class="our-shelter-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5><?php _e("Our Shelter", "catspride"); ?></h5>
                                        <p><?php echo $shelter_name; ?></p>
                                        <?php if (!empty($address_formatted) && $shelter_address_visibility) { ?>
                                            <p class="shelter-address"><?php echo $address_formatted; ?></p>
                                        <?php } ?>
                                        <?php if (!empty($shelter_contact) && $shelter_contact_name_visibility) { ?>
                                            <strong><?php _e('Contact Name', 'catspride'); ?></strong>
                                            <p class="shelter-contact"><?php echo $shelter_contact; ?></p>
                                        <?php } ?>
                                        <?php if (!empty($shelter_phone) && $shelter_phone_visibility) { ?>
                                            <strong><?php _e('Phone Number', 'catspride'); ?></strong>
                                            <p class="shelter-phone"><?php echo $shelter_phone; ?></p>
                                        <?php } ?>
                                        <?php if (!empty($shelter_email) && $shelter_email_visibility) { ?>
                                            <strong><?php _e('Email', 'catspride'); ?></strong>
                                            <p class="shelter-email"><a href="mailto:<?php echo $shelter_email; ?>"
                                                    target="_blank"><?php echo $shelter_email; ?></a>
                                            </p>
                                        <?php } ?>
                                        <?php if (!empty($shelter_website) && $shelter_website_visibility) { ?>
                                            <strong><?php _e('Website', 'catspride'); ?></strong>
                                            <p class="shelter-website"><a href="<?php echo $shelter_website; ?>"
                                                    target="_blank"><?php echo $shelter_website; ?></a>
                                            </p>
                                        <?php } ?>
                                        <?php if ((!empty($shelter_facebook) || !empty($shelter_twitter) || !empty($shelter_instagram))
                                            &&  ($shelter_facebook_visibility || $shelter_instagram_visibility || $shelter_twitter_visibility)
                                        ) { ?>
                                            <span class="shelter-social-media">
                                                <h5>Follow us</h5>
                                                <p>
                                                    <?php if (!empty($shelter_facebook) && $shelter_facebook_visibility) { ?>
                                                        <a href="<?php echo esc_attr($shelter_facebook); ?>">
                                                            <i class="fa-brands fa-facebook"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (!empty($shelter_instagram) && $shelter_instagram_visibility) { ?>
                                                        <a href="<?php echo esc_attr($shelter_instagram); ?>">
                                                            <i class="fa-brands fa-square-instagram"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (!empty($shelter_twitter) && $shelter_twitter_visibility) { ?>
                                                        <a href="<?php echo esc_attr($shelter_twitter); ?>">
                                                            <i class="fa-brands fa-square-twitter"></i>
                                                        </a>
                                                    <?php } ?>
                                                </p>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if (!empty($our_mission)) { ?>
                                            <h5><?php _e("Our Mission", "catspride"); ?></h5>
                                            <p><?php echo $our_mission; ?></p>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                <?php } ?>

            </div>

        </article>

    <?php endwhile; ?>

</div>

<?php get_footer(); ?>