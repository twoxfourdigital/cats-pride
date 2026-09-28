<?php

global $post;

// Retrieve the user's managed shelter
$user_id           = get_current_user_id();
$user              = get_user_by( 'ID', $user_id );
$manage_shelter_id = get_user_meta( $user_id, '_cp_manage_shelter_id', true );
$manage_shelter    = ($manage_shelter_id) ? get_post( $manage_shelter_id ) : false;
$profile_completed = ( !empty( get_post_meta( $manage_shelter_id, '_cp_shelter_profile_completed', true ) ) ) ? true : false;
$nomination_count  = cp_get_shelter_nomination_count( $manage_shelter_id );
$plugin_dir = WP_PLUGIN_URL . '/cats-pride';
?>

<div id="Hero" class="x-section blue bg-pattern page-shelter page-shelter-dashboard page-shelter-resources clearfix">
    <div class="container max width mobile-center-text">
		<div id="shelter-media" class="x-column x-sm mobile-center-text x-1-1" style="padding: 10px 0px 0px; clearfix">

			<div class="headline mbl" style="">
				<h1 class="h-custom-headline white h1 mobile-s-36" style="line-height: 1">
					<span><?php _e('Welcome','catspride'); ?>, <br><strong><?php echo $manage_shelter->post_title; ?>!</strong></span>
				</h1>
				<h2 class="h-custom-headline white h3 mobile-s-18" style="line-height: 1"><span><?php echo get_field( 'header_sub_title' ); ?></span></h2>
			</div>
        	<div id="shelter-image" class="shelter-media-holder image-holder" style="">
            <?php
           
            if(get_field( 'header_image' )): ?>

                
                <img src="<?php esc_attr_e( get_field( 'header_image' ) ); ?>" />
                <?php else: ?>
                    <img src='<?php echo $plugin_dir; ?>/assets/images/LFG_Short_Logo-v2.png' />
                <?php  endif;?> 
            </div>
            <div class="cp-shelter-nomination-wrapper cp-shelter-resources-nomination-count-wrapper mobile-s-16">
                <p style="line-height: normal">Litter for Good nominations received as of <span><?php echo date('n/d/Y'); ?></span></p>
                <span class="count"><?php echo number_format( $nomination_count ); ?></span>
            </div>

        </div>
    </div>
</div>

<div class="section page-shelter-resources" style="margin-top:30px;">

    <div class="container max width">

        <?php if ( wc_notice_count() > 0 ) { ?>

            <div class="x-container max width" style="margin-bottom:-50px;">
                <div class="x-column x-sm x-1-1">
                    <?php wc_print_notices(); ?>
                </div>
            </div>

        <?php }

        $current_tab = ( isset( $_REQUEST['tab'] ) && !empty( $_REQUEST['tab'] ) ) ? $_REQUEST['tab'] : 'welcome';

        ?>

        
        
        <div class="tabs">
  <div class="tab-buttons">

    <?php $tabs = '

    <button class="tab-btn '. ($current_tab === 'welcome' ? 'active' : '') .'" data-tab="partial-tab-welcome">' . __( 'Welcome', 'catspride' ) . '</button>
    <button class="tab-btn '.($current_tab === 'manage-my-shelter-page' ? 'active' : '').'" data-tab="partial-tab-manage-my-shelter-page">' . __( 'Edit My Shelter', 'catspride' ) . '</button>
    <button class="tab-btn '.($current_tab === 'promo-tools' ? 'active' : '').'" data-tab="partial-tab-promo-tools">' . __( 'Promo Tools', 'catspride' ) . '</button>
    <button class="tab-btn '.($current_tab === 'my-account' ? 'active' : '').'" data-tab="partial-tab-my-account">' . __( 'My Account', 'catspride' ) . '</button>';
    
    echo $tabs; 
    
    ?></div>
        

        
        <!-- Tab: Welcome Start -->
        <div id="partial-tab-welcome" class="tab-content active" >
            <?php include( 'partials/partial-tab-welcome.php' ); ?>
           
        </div>
        <!-- Tab: Welcome End -->
       

        
        <!-- Tab: Manage My Shelter Page Start -->
        <div id="partial-tab-manage-my-shelter-page" class="tab-content">
            <?php include( 'partials/partial-tab-manage-my-shelter-page.php' ); ?>
        </div>
        <!-- Tab: Manage My Shelter Page End -->
       
        <!-- Tab: Promo Tools Start -->
        <div id="partial-tab-promo-tools" class="tab-content">
            <?php include( 'partials/partial-tab-promo-tools.php' ); ?>
        </div>
        <!-- Tab: Promo Tools End -->
       
        <!-- Tab: My Account Start -->
        <div id="partial-tab-my-account" class="tab-content">
            <?php include( 'partials/partial-tab-my-account.php' ); ?>
        </div>
       
        </div>
       
        

    </div>

</div>