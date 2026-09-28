<?php if ( $show_title === true ) : ?>
	<h2 class="h-custom-headline h3"><span>Join the <strong>Cat's Pride Club.</strong></span></h2>
<?php endif; ?>
<?php if ( $show_subtitle === true ) : ?>
	<div class="x-text man mbm">
    	<p><?php _e('Members get exclusive access to coupons and offers, and can help give back to local shelters.', 'catspride'); ?></p>
	</div>
<?php endif; ?>
<p class="button-wrapper">
    <a class="x-btn <?php echo $button_class; ?> mtm mobile-mbm x-btn-global" <?php echo ( isset( $link_id ) && !empty( $link_id ) ) ? 'id="' . esc_attr( $link_id ) . '"' : ''; ?> href="<?php echo esc_attr( home_url( '/join-the-club/user-registration/member-dashboard/' ) ); ?>" title="Join The Club - SIGN UP HERE">SIGN UP HERE</a>
</p>