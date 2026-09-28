<?php

$shelter = get_post( $manage_shelter_id );

$shelter_page_url  = get_permalink( $shelter-> ID );
$shelter_name      = $shelter->post_title;
$shelter_contact   = get_field( 'contact', $shelter->ID );
$shelter_ein       = get_field( 'ein', $shelter->ID );
$shelter_address_1 = get_field( 'address_1', $shelter->ID );
$shelter_address_2 = get_field( 'address_2', $shelter->ID );
$shelter_city      = get_field( 'city', $shelter->ID );
$shelter_state     = get_field( 'state', $shelter->ID );
$shelter_zip_code  = get_field( 'zip_code', $shelter->ID );

$address_formatted = '';

if ( ! empty( $shelter_address_1 ) ) {
    $address_formatted .= $shelter_address_1;
}
if ( ! empty( $shelter_address_2 ) ) {
    if ( !empty( $address_formatted ) ) {
        $address_formatted .= '<br>';
    }
    $address_formatted .= $shelter_address_2;
}
if ( ! empty( $address_formatted ) ) {
    $address_formatted .= '<br>' . $shelter_city . ', ' . $shelter_state . ' ' . $shelter_zip_code;
}

$shelter_phone     = get_field( 'phone', $shelter->ID );
$shelter_email     = get_field( 'email', $shelter->ID );
$shelter_website   = get_field( 'website', $shelter->ID );
$shelter_facebook  = get_field( 'facebook', $shelter->ID );
$shelter_twitter   = get_field( 'twitter', $shelter->ID );
$shelter_instagram = get_field( 'instagram', $shelter->ID );

$shelter_creation_date = $shelter->post_date;
$shelter_our_mission   = $shelter->post_content;
$nomination_count      = cp_get_shelter_nomination_count( $shelter->ID );

$upload_path_url = wp_upload_dir();
$upload_path_url = $upload_path_url[ 'baseurl' ] . '/cp_shelter_uploads/';

$attachments = get_post_meta( $shelter->ID, 'slideshow_attachments', true);
$attachments = ( $attachments ) ? $attachments : [];

/*
 * Shelter Page Visibility Rules
 */
$shelter_page_header_type          = ( isset( $_POST['page_header_type'] ) ) ? $_POST['page_header_type'] : get_field( 'page_header_type', $shelter->ID );
$shelter_page_header_video         = ( isset( $_POST['page_header_video'] ) ) ? $_POST['page_header_video'] : get_field( 'page_header_video', $shelter->ID );
$shelter_page_header_slides        = ( isset( $_POST['page_header_slideshow'] ) ) ? $_POST['page_header_slideshow'] : get_field( 'page_header_slideshow', $shelter->ID );
$shelter_page_visibility           = ( isset( $_POST['page_visible'] ) ) ? $_POST['page_visible'] : get_field( 'page_visible', $shelter->ID );

$shelter_page_visibility = ( $shelter_page_visibility === 0 ||  $shelter_page_visibility === false) ? 0 : 1;

$shelter_contact_name_visibility   = ( isset( $_POST['contact_name_visible'] ) ) ? $_POST['contact_name_visible'] : get_field( 'contact_name_visible', $shelter->ID );
$shelter_phone_visibility          = ( isset( $_POST['phone_visible'] ) ) ? $_POST['phone_visible'] : get_field( 'phone_visible', $shelter->ID );
$shelter_email_visibility          = ( isset( $_POST['email_visible'] ) ) ? $_POST['email_visible'] : get_field( 'email_visible', $shelter->ID );

$shelter_address_visibility        = ( isset( $_POST['address_visible'] ) ) ? $_POST['address_visible'] : get_field( 'address_visible', $shelter->ID );
$shelter_address_visibility        = ( $shelter_address_visibility === null ) ? 1 : 0;
$shelter_website_name_visibility   = ( isset( $_POST['website_visible'] ) ) ? $_POST['website_visible'] : get_field( 'website_visible', $shelter->ID );
$shelter_website_name_visibility   = ( $shelter_website_name_visibility === null ) ? 1 : 0;
$shelter_facebook_name_visibility  = ( isset( $_POST['facebook_visible'] ) ) ? $_POST['facebook_visible'] : get_field( 'facebook_visible', $shelter->ID );
$shelter_facebook_name_visibility  = ( $shelter_facebook_name_visibility === null ) ? 1 : 0;
$shelter_instagram_visibility      = ( isset( $_POST['instagram_visible'] ) ) ? $_POST['instagram_visible'] : get_field( 'instagram_visible', $shelter->ID );
$shelter_instagram_visibility      = ( $shelter_instagram_visibility === null ) ? 1 : 0;
$shelter_twitter_visibility        = ( isset( $_POST['twitter_visible'] ) ) ? $_POST['twitter_visible'] : get_field( 'twitter_visible', $shelter->ID );
$shelter_twitter_visibility        = ( $shelter_twitter_visibility === null ) ? 1 : 0;

?>

<form method="post" class="manage-my-shelter">

    <div class="x-container max width row" style="padding: 0px 0 0px;">

        <div class="x-column x-sm x-2-3 row"  style="padding: 0px 0 50px;">

            <h2 class="h-custom-headline cp-fc-header-header s-20 w-700 mobile-s-20 mobile-mbm col-md-12">Edit My Shelter</h2>
            <p class="s-12 mobile-s-18 col-md-12">Your supporters can now nominate your shelter with one click. Customize your public Shelter Page by adding or editing content and adjusting your page settings and then share the link with your supporters!</p>
 
            <div class="x-column x-sm x-1-2 mobile-center-text col-md-6">
                <a href="<?php echo esc_attr( $shelter_page_url ); ?>" target="_blank" class="x-btn blue-alt mobile-mbl primary-button--light-blue">View My Shelter Page</a>
            </div>
            <div class="x-column x-sm x-1-2 last mobile-center-text  col-md-6">
                <button id="cp-copy-shelter-page-url" type="button" class="x-btn blue-alt primary-button--light-blue" data-shelter_url="<?php echo esc_attr( $shelter_page_url ); ?>">Copy Shelter Page Link</button>
            </div>
 
 		    <hr style="margin-top: 50px;margin-bottom: 30px;border-top: solid 2px #9b9b9b;">

        </div>

        <div class="x-column x-sm x-2-3 s-12 mobile-s-18 mobile-mbl mobile-pbl col-md-8" style="line-height: normal;">

            <h4 class="s-16 w-700">Shelter Page Header</h4>
            <p>Promote your shelter with image(s) or YouTube video.</p>
            <span class="shelter-page-header-type-input-wrapper mrs pls prs pbs">
                <label>
                    <input type="radio" name="page_header_type" value="slideshow" <?php checked( $shelter_page_header_type, 'slideshow' ); ?>>
                    Slideshow image(s)
                </label>
            </span>

            <span class="shelter-page-header-type-input-wrapper pls prs pbs">
                <label>
                    <input type="radio" name="page_header_type" value="video" <?php checked( $shelter_page_header_type, 'video' ); ?>>
                    YouTube Video
                </label>
            </span>
            <div class="shelter-page-header-type shelter-page-header-type-slideshow">
                <p>Use the tool below to upload up to 4 images or your shelter's logo. When no content is uploaded, our Litter for Good default image appears.</p>
                <p class="cp-upload-requirements">Upload JPG or PNG images with a max size of 2MB each, max of 4 images. To prevent cropping, upload images with dimensions of 450px x 230px.</p>
                <div id="shelter-resources-upload" class="dropzone">
                </div>
                <div id="shelter-resources-attachments" class="shelter-resources-attachments mobile-center-text">
                    <?php if ( count( $attachments ) > 0 ) { ?>
                        <ul class="cp-shelter-page-attachment-list mobile-center-text">
                        <?php foreach( $attachments as $attachment ) { ?>
                            <li class="x-column x-sm x-1-4 attachment-thumbnail mobile-mtl">
                                <img src="<?php echo $upload_path_url . esc_attr( $attachment ); ?>" class="cp-shelter-page-attachment" />
                                <button type="button" data-file_name="<?php echo esc_attr( $attachment ); ?>" class="primary-button--light-blue x-btn x-btn-mini remove-attachment mobile-mtm">Remove</button>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <div class="x-clear"></div>
            </div>
            <div class="shelter-page-header-type shelter-page-header-type-video">
                <label for="page_header_video">YouTube Video Link</label>
                <input type="text" name="page_header_video" value="<?php echo esc_attr( $shelter_page_header_video ); ?>" />

                <?php if ( !empty( $shelter_page_header_video ) ) {
                    echo cp_convert_youtube_url_to_embed( $shelter_page_header_video );
                } ?>
                <button class="x-btn blue-alt mts primary-button--light-blue">Submit</button>
            </div>

            <hr style="margin-top: 60px;margin-bottom: 30px;border-top: solid 2px #9b9b9b;">

            <h4 class="s-16 w-700">Our Mission</h4>
            <p>This is your chance to put your actions into words and inspire your supporters to nominate you today. Tell them what you stand for, why you got started, and what you hope your organization will achieve.</p>
            <textarea name="our_mission_text" class="man" placeholder="Click to enter text"><?php echo $shelter_our_mission; ?></textarea>

            <hr style="margin-top: 40px;margin-bottom: 25px;border-top: solid 2px #9b9b9b;">

            <?php wp_nonce_field( 'catspride-edit_shelter_page' ); ?>
            <input type="hidden" name="action" value="edit_shelter_page" />

            <button type="submit" class="x-btn x-btn-primary blue-alt mrl primary-button--light-blue">Save</button>
            <button type="reset" class="x-btn x-btn-secondary blue-alt grey primary-button--light-blue">Cancel</button>

        </div>

        <div class="x-column x-sm x-1-3 catspride-ShelterResources-shelter-info-wrapper s-12 mobile-s-18 mobile-mtl mobile-ptl col-md-4" style="line-height: normal;">

            <h4 class="s-16 w-700">Shelter Page Settings</h2>

            <p class="mbn mtl">Your Shelter Page Access</p>
            <hr style="margin-top: 2px;margin-bottom: 5px;border-top: solid 2px #9b9b9b;">

            <label  class=" w-700 mbs">Everyone can view your Shelter Page?</label>
            <span class="shelter-page-access-input-wrapper mrm">
                <label for="page_visible">Yes</label>
                <input type="radio" name="page_visible" value="1" <?php checked( $shelter_page_visibility, 1 ); ?> />
            </span>
            <span class="shelter-page-access-input-wrapper">
                <label for="page_visible">No</label>
                <input type="radio" name="page_visible" value="0" <?php checked( $shelter_page_visibility, 0 ); ?> />
            </span>

            <p class="mbn mtl">Your Shelter Page URL</p>
            <hr style="margin-top: 2px;margin-bottom: 5px;border-top: solid 2px #9b9b9b;">
            <p>Copy the URL below to share with your followers across email and social media. Ask your supporters to nominate you for litter donations.</p>
            <br>
            <a href="<?php echo esc_attr( $shelter_page_url ); ?>" target="_blank" title="Shelter Page">
                <?php echo $shelter_page_url; ?>
            </a>
            <br>
            <br>
            <p class="mbn mtl">Your Shelter Page Information</p>
            <hr style="margin-top: 2px;margin-bottom: 5px;border-top: solid 2px #9b9b9b;">
            <p>Sharing your contact information and social media links on your Shelter Page can help increase your nominations, which means more litter donations. Choose how much information you wish to share by switching on or off. You can make changes to this information in your <a href="/member-dashboard/shelter-resources/?tab=my-account">My Account</a>.</p>

            <hr class="" style="margin-top: 8px;margin-bottom: 15px;border-top: solid 2px #9b9b9b;">

            <ul class="cp-shelter-page-information-list s-12 mobile-s-18">
                <li class="mbl">
                    <?php if ( $address_formatted ) { ?>
                   
                    <span class="cp-shelter-checked">
                        <input type="checkbox" id="address_visible" name="address_visible" <?php checked( $shelter_address_visibility, 1 ); ?>>
                    </span>
                    <label for="address_visible" class="cp-shelter-value"><?php echo $address_formatted; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_contact ) { ?>
                        <span class="cp-shelter-checked">
                            <input type="checkbox" id="contact_name_visible" name="contact_name_visible" <?php checked( $shelter_contact_name_visibility, 1 ); ?> />
                        </span>
                        <label for="contact_name_visible" class="cp-shelter-value"><?php echo $shelter_contact; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_phone ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox" id="phone_visible" name="phone_visible" <?php checked( $shelter_phone_visibility, 1 ); ?> /></span>
                        <label for="phone_visible" class="cp-shelter-value"><?php echo $shelter_phone; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_email ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox" id="email_visible" name="email_visible" <?php checked( $shelter_email_visibility, 1 ); ?> /></span>
                        <label class="cp-shelter-value" for="email_visible"><?php echo $shelter_email; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_website ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox" id="website_visible" name="website_visible" <?php checked( $shelter_website_name_visibility, 1 ); ?> /></span>
                        <label class="cp-shelter-value" for='website_visible'><?php echo $shelter_website; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_facebook ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox" id="facebook_visible" name="facebook_visible" <?php checked( $shelter_facebook_name_visibility, 1 ); ?> /></span>
                        <label class="cp-shelter-value" for='facebook_visible'><?php echo $shelter_facebook; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_instagram ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox"  id="instagram_visible" name="instagram_visible" <?php checked( $shelter_instagram_visibility, 1 ); ?> /></span>
                        <label class="cp-shelter-value" for="instagram_visible"><?php echo $shelter_instagram; ?></label>
                    <?php } ?>
                </li>
                <li class="mbl">
                    <?php if ( $shelter_twitter ) { ?>
                        <span class="cp-shelter-checked"><input type="checkbox" id="twitter_visible" name="twitter_visible" <?php checked( $shelter_twitter_visibility, 1 ); ?> /></span>
                        <label class="cp-shelter-value" for="twitter_visible"><?php echo $shelter_twitter; ?></label>
                    <?php } ?>
                </li>
            </ul>

        </div>

    </div>

</form>