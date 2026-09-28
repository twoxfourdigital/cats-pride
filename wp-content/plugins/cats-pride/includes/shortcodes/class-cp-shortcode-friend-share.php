<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Friend Share Shortcode
 *
 */
class CP_Shortcode_Friend_Share {

    /**
     * Get the shortcode content.
     *
     * @param array $atts
     * @return string
     */
    public static function get( $atts ) {
        return CP_Shortcodes::shortcode_wrapper( array( __CLASS__, 'output' ), $atts );
    }

    /**
     * Output the shortcode.
     *
     * @param array $atts
     */
    public static function output( $atts ) {

        $headline    = ( isset( $atts['headline'] ) && !empty( $atts['headline'] ) ) ? $atts['headline'] : '';
        $description = ( isset( $atts['description'] ) && !empty( $atts['description'] ) ) ? $atts['description'] : '';

        ?>

        <div class="cp-shortcode-friend-share-wrapper">

            <?php if ( !empty( $headline ) ) { ?>
            <h2 class="h-custom-headline h3"><?php _e( $headline, 'catspride' ); ?></h2>
            <?php } ?>

            <?php if ( !empty( $description ) ) { ?>
                <p class="description"><?php _e( $description, 'catspride' ); ?></p>
            <?php } ?>

            <form class="catspride-FriendShareForm cp-form" method="post">

                <div class="x-container">
                    <div class="x-column x-sm x-1-4">
                        <label for="friend_share_name"><?php _e('Your Name', 'catspride'); ?> <span class="required">*</span></label>
                        <input type="text" class="catspride-Input catspride-Input--text input-text" name="friend_share_name"
                               id="friend_share_name" required="required"
                               value="<?php echo (isset($_POST['friend_share_name'])) ? esc_attr($_POST['friend_share_name']) : ''; ?>"/>
                    </div>
                    <div class="x-column x-sm x-1-4">
                        <label for="friend_share_email"><?php _e('Your Email', 'catspride'); ?> <span class="required">*</span></label>
                        <input type="email" class="catspride-Input catspride-Input--text input-text" name="friend_share_email"
                               id="friend_share_email" required="required"
                               value="<?php echo (isset($_POST['friend_share_email'])) ? esc_attr($_POST['friend_share_email']) : ''; ?>"/>
                    </div>
                    <div class="x-column x-sm x-1-4">
                        <label for="friend_share_friend_email"><?php _e('Your Friend\'s Email', 'catspride'); ?> <span class="required">*</span></label>
                        <input type="email" class="catspride-Input catspride-Input--text input-text" name="friend_share_friend_email"
                               id="friend_share_friend_email" required="required"
                               value="<?php echo (isset($_POST['friend_share_friend_email'])) ? esc_attr($_POST['friend_share_friend_email']) : ''; ?>"/>
                    </div>
                    <div class="x-column x-sm x-1-4">
                        <input id="friend_share_email_submit" class="x-btn green x-btn-global" type="submit" value="<?php _e('Submit', 'catspride'); ?>" style="margin-top:23px;"/>
                    </div>
                </div>

                <input type="hidden" name="action" value="friend_share" />
                <?php wp_nonce_field( 'catspride-friend_share' ); ?>

            </form>

            <script type="text/javascript">
                jQuery('.friend-share-trigger').click( function() {
                    jQuery('.friend-share-container').slideToggle();
                });
            </script>

        </div>

        <?php

    }

}
