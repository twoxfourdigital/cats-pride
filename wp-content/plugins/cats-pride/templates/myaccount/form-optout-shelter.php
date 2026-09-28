<?php
/**
 * Optout shelter form
 */

if (!defined('ABSPATH')) {
    exit;
}


do_action('catspride_before_optout_shelter_form'); ?>

    <div style="margin: 30px auto;padding: 25px 30px;" class="x-container max width">

        <?php if ( wc_notice_count() > 0 ) { ?>

            <div class="x-container max width">
                <div class="x-column x-sm x-1-1">
                    <?php wc_print_notices(); ?>
                </div>
            </div>

        <?php } ?>

        <div class="x-section">

            <h1 style="margin-bottom:30px;"><?php _e('Shelter Opt-Out', 'catspride'); ?></h1>

            <form class="catspride-OptOutShelterForm nominate-shelter cp-form" action="" method="post">

                <?php do_action('catspride_optout_shelter_form_start'); ?>

                <div class="x-container">
                    <p><?php _e('By opting-out of the Litter for Good program, you understand that all nominations for your shelter will be removed and your shelter will no longer be eligible for litter donations.', 'catspride');?></p>
                    <p><?php _e('By checking the box below, you are confirming that you understand and would like to continue with the opt-out process. We will send you a confirmation email to your account\'s email address. Click on the provided URL in the email to confirm your desire to opt-out of the program.', 'catspride');?></p>
                </div>
                <div class="x-container">
                    <input type="checkbox" name="optout_confirm" value="1"><label for="optout_confirm" style="margin-left:15px;"><?php _e('I understand.'); ?></label>
                </div>

                <?php do_action('catspride_optout_shelter_form'); ?>

                <hr>
                <div class="x-container">
                    <?php wp_nonce_field('catspride-optout_shelter'); ?>
                    <a href="<?php echo wc_get_page_permalink('myaccount'); ?>" title="Return to My Account" style="margin-right:15px;">cancel</a>
                    <input type="submit" class="catspride-Button button" name="optout_shelter"
                           value="<?php esc_attr_e('Confirm Opt-Out', 'catspride'); ?>"/>
                    <input type="hidden" name="action" value="optout_shelter"/>
                </div>

                <?php do_action('catspride_optout_shelter_form_end'); ?>
            </form>

        </div>

    </div>


<?php do_action('catspride_after_optout_shelter_form'); ?>