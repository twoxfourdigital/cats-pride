<?php

global $cp_shelters;

$is_nomination = ( isset($_POST['action']) && $_POST['action'] === 'nominate_shelter' ) ? true : false;
$is_choose_shelter = ( isset($_POST['action']) && ($_POST['action'] === 'find_shelters' || $_POST['action'] === 'choose_shelter' ) ) ? true : false;

if ( (!$is_nomination && !$is_choose_shelter)
    || ( $is_nomination && count( $cp_shelters ) === 0 ) ) {

    return;
}

$user_id    = get_current_user_id();
$shelter    = null;
$shelter_id = null;

if ( $cp_shelters && count($cp_shelters) > 0 ) {
    $shelters = $cp_shelters;
}

if ($user_id) {

    $nomination = cp_get_current_shelter_nomination_for_user( $user_id );
    $shelter_id = ( $nomination ) ? $nomination->shelter_post_id : null;

    // Retrieve the user's favorite/nominated shelter
    $shelter = ( $shelter_id ) ? get_post( $shelter_id ) : false;
}

?>

<div class="x-section catspride-NominateShelter-wrapper">

    <div class="x-container max width">

        <?php if ( $is_choose_shelter && isset( $_POST['zip_code'] ) ) { ?>
            <p class="results-shelter-text"><?php _e('Showing results within 100 miles of <strong>' . $_POST['zip_code'] . '</strong>', 'catspride'); ?></p>
        <?php } else { ?>
            <h1><?php _e( 'Similar Shelters Found', 'catspride'); ?></h1>
            <p class="results-shelter-text"><?php _e('We found existing shelters similar to the one you are attempting to submit. Would you like to nominate one of the following shelters instead?', 'catspride'); ?></p>
        <?php }

        /*
         * Output params
         */
        $columns = 3;
        $loop = 0;

        if (isset( $shelters ) && count( $shelters ) > 0) {

            $total_shelters = count( $shelters );

            foreach ($shelters as $shelter) {

                if ($loop % $columns === 0) { ?>
                    <div class="x-container">
                <?php } ?>

                <div class="x-column x-sm x-1-<?php echo $columns; ?> catspride-NominateShelter-single bk-blue bb-blue colorbox <?php if ($shelter_id == $shelter->shelter_id) { echo "catspride-NominateShelter-your-shelter"; } ?>"
                     style="text-align:center;">
                    <h4 class="h-custom-headline white tt-upper h3"><?php echo $shelter->name; ?></h4>
                    <p class="subtext"><?php echo $shelter->city . ', ' . $shelter->state; ?></p>

                    <?php

                    $shelter_page_url  = get_permalink( $shelter->shelter_id );

                    ?>

                    <?php if ($shelter->post_status === 'publish') { ?>
                        <a href="<?php echo esc_attr( $shelter_page_url ); ?>" class="visit-shelter-link" target="_blank">Visit Shelter Profile</a>
                    <?php } ?>

                    <?php if ($shelter_id == $shelter->shelter_id) { ?>
                        <span class="catspride-NominateShelter-selected"><?php _e('Your Shelter', 'catspride'); ?></span>
                    <?php } else { ?>

                        <button class="x-btn blue-rev mtm primary-button--white-blue catspride-NominateShelter-button"
                                data-shelter_id="<?php echo $shelter->shelter_id; ?>"
                                data-shelter_name="<?php esc_attr_e( $shelter->name ); ?>"
                                data-shelter_location="<?php esc_attr_e( $shelter->city . ', ' . $shelter->state ); ?>"
                                type="button"><?php _e('Nominate', 'catspride'); ?></button>

                        <input class="catspride-NominateShelter-zip_code cp-form-input" type="hidden" name="zip_code" value="<?php echo ( isset( $_REQUEST['zip_code'] ) && !empty( $_REQUEST['zip_code'] ) ) ? $_REQUEST['zip_code'] : ''; ?>" />
                    <?php } ?>
                    <?php if ($shelter->post_status === 'draft') { ?>
                        <p class="catspride-NominateShelter-awaiting-enrollment"><?php _e('Awaiting shelter enrollment', 'catspride'); ?></p>
                    <?php } ?>

                </div>

                <?php $loop++; ?>

                <?php if ($loop % $columns === 0 || $loop === $total_shelters) { ?>
                    </div>
                <?php } ?>

            <?php }

        } else if ( $is_choose_shelter ) { ?>

            <p class="no-shelter-found-text"><?php echo sprintf(__('No shelters found. Nominate a shelter near you <a href="%s" target="_self" title="Nominate a Shelter">here</a>.', 'catspride'), wc_get_endpoint_url('nominate-shelter')); ?></p>

        <?php } ?>

    </div>

</div>
