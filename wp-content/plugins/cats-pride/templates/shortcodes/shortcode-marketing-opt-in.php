<?php

if ( is_user_logged_in() && wc_notice_count('success') === 0) {
    $user = wp_get_current_user();
}

if ( function_exists( 'wc_print_notices' ) ) {
    wc_print_notices();
}

?>

<form class="catspride-MarketingOptInForm edit-shelter" method="post">

    <div class="x-container">
        <div class="x-column x-sm x-1-3">
            <input type="text" class="catspride-Input catspride-Input--text input-text" name="email" id="marketing_opt_in_email" placeholder="Enter Email Address" value="<?php echo ( isset( $user ) && $user ) ? $user->user_email : ''; ?>" style="height: 37px;width:100%;"/>
        </div>
        <div class="x-column x-sm x-1-4">
            <input type="submit" class="catspride-Button button" name="marketing_optin" value="<?php esc_attr_e( 'Submit', 'catspride' ); ?>" style="margin-top:-3px" />
            <?php wp_nonce_field( 'catspride-marketing_opt_in' ); ?>
            <input type="hidden" name="action" value="marketing_opt_in" />
        </div>
    </div>

</form>