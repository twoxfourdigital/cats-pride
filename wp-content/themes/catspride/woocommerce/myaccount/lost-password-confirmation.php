<?php
/**
 * Lost password lost_reset_password text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-account-login">
	<div class="woocommerce-ResetPassword lost_reset_password lost_reset_password_lost_reset_password">
   <?php

        wc_print_notices();
        //wc_print_notice( __( 'Password reset email has been sent.', 'woocommerce' ) );

    ?>

        <h1 class="h-custom-headline section-title h2 w-700">Password reset email has been sent</h1>

    <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. You may also want to check your spam folder just in case. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ); ?></p>
	</div>
</div>