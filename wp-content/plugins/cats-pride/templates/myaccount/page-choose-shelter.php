<?php
/**
 * Choose a Shelter Page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$shelters = array();
$zip_code = '';

if ( isset( $_REQUEST['zip_code'] )
    && !empty( $_REQUEST['zip_code'] ) ) {

    $zip_code   = intval( $_REQUEST['zip_code'] );
    $geo_coords = cp_get_nearest_lat_lon_by_zip( $zip_code );

    if ( $geo_coords ) {
        $shelters = cp_get_nearest_posts_by_lat_lon( $geo_coords['lat'], $geo_coords['lon'], 'cp_shelter' );
    }

}

?>

<div id="Hero" class="x-section green bg-pattern choose-shelter">
    <div class="x-container max width marginless-columns">
        <div class="x-column x-sm x-3-5">
        	<h1 class="h-custom-headline white tt-upper h1"><span><?php _e('Choose <strong>Your Shelter</strong>', 'catspride'); ?></span></h1>
            <!-- <h2 class="h-custom-headline white h3"><span><?php _e('Help us donate 20 million pounds by 2020!', 'catspride'); ?></span></h2> -->
            <h2 class="h-custom-headline white h3"><span><?php _e('Donate litter to your favorite shelter', 'catspride'); ?></span></h2>

			<div class="x-text man mbm white mtl">
				<p><?php _e('Nominate a shelter to receive litter donations. The more a shelter receives, the more litter that is donated. As shelters enroll, you\'ll be able to search for them here.', 'catspride'); ?></p>
        	</div>
            
        </div>
        <div class="x-column x-sm colorbox join bk-green x-2-5 center" style="">
            <h2 class="h-custom-headline tt-upper h3"><span>Search by zip code</span></h2>
            <div class="man mbm">
            	<p></p>
			</div>
            <form id="catspride-FindSheltersForm" class="catspride-FindSheltersForm cp-form" method="post">
                <input id="zip_code" type="text" name="zip_code" value="<?php echo $zip_code; ?>" />
                <?php wp_nonce_field( 'catspride-find_shelters' ); ?>
                <input type="hidden" name="action" value="find_shelters" />
                <button class="x-btn primary-button--white-green x-btn-global mts"><?php _e('Submit', 'catspride'); ?></button>
            </form>
        </div>
    </div>
</div>

<?php if ( wc_notice_count() > 0 ) { ?>

    <div class="x-container max width" style="margin-bottom:-50px;">
        <div class="x-column x-sm x-1-1">
            <?php wc_print_notices(); ?>
        </div>
    </div>

<?php } ?>

<?php include( 'partials/partial-available-shelters.php' ); ?>

<div class="x-container bk-grey max width marginless-columns catspride-NominateShelterBanner">
	<div class="x-column x-sm x-2-3" style="padding: 0px;">
		<h2 class="h-custom-headline w-700 h3 mts"><span><?php echo sprintf( __('Can\'t find your local shelter? Nominate them <a href="%s" target="_self" title="Nominate a Shelter">here</a>.', 'catspride'), wc_get_endpoint_url( 'nominate-shelter' ) ); ?></span></h2>
	</div>
	<div class="x-column x-sm x-1-3" style="padding: 0px;">
		<a class="x-btn primary-button--purple x-btn-global" href="<?php echo sprintf( __('%s', 'catspride'), wc_get_endpoint_url( 'nominate-shelter' ) ); ?>" target="_self" title="Nominate a Shelter" data-options="thumbnail: ''">Nominate a Shelter</a>
	</div>
</div>

<?php add_action('wp_footer', function() { ?>

    <?php include( 'partials/partial-choose-shelter-modal.php' ); ?>

<?php }); ?>