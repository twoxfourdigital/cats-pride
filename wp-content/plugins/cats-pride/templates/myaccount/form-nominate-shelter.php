<?php
/**
 * Nominate shelter form
 */

if (!defined('ABSPATH')) {
    exit;
}

global $cp_shelters;

// Get states for select population
$countries_obj = new WC_Countries();
$countries = $countries_obj->__get('countries');
$default_country = $countries_obj->get_base_country();
$default_county_states = $countries_obj->get_states($default_country);

do_action('catspride_before_nominate_shelter_form'); ?>
<div class="nominate-shelter">
    <div style="margin: 30px auto;padding: 25px 30px;" class="x-container max width">

        <?php if ( wc_notice_count() > 0 ) { ?>

            <div class="x-container max width">
                <div class="x-column x-sm x-1-1">
                    <?php wc_print_notices(); ?>
                </div>
            </div>

        <?php } ?>

        <div class="x-section">

            <?php include( 'partials/partial-available-shelters.php' ); ?>

            <h1 style="margin-bottom:30px;"><?php _e('Shelter Nomination', 'catspride'); ?></h1>

            <form class="catspride-NominateShelterForm nominate-shelter cp-form" action="" method="post">

                <?php do_action('catspride_nominate_shelter_form_start'); ?>

                <div class="x-container">
                    <label for="shelter_name"><?php _e('Shelter\'s Name', 'catspride'); ?> <span
                                class="required">*</span></label>
                    <input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_name"
                        id="shelter_name"
                        value="<?php echo (isset($_POST['shelter_name'])) ? esc_attr( $_POST['shelter_name'] ) : ''; ?>"/>
                </div>

                <div class="x-container">
                    <label for="shelter_email"><?php _e('Shelter\'s Email', 'catspride'); ?> </label>
                    <input type="email" class="catspride-Input catspride-Input--text input-text" name="shelter_email"
                        id="shelter_email"
                        value="<?php echo (isset($_POST['shelter_email'])) ? esc_attr($_POST['shelter_email']) : ''; ?>"/>
                </div>

                <div class="x-container">
                    <div class="x-column x-sm x-3-4">
                        <label for="shelter_city"><?php _e('City', 'catspride'); ?> <span
                                    class="required">*</span></label>
                        <input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_city"
                            id="shelter_city"
                            value="<?php echo (isset($_POST['shelter_city'])) ? $_POST['shelter_city'] : ''; ?>"/>
                    </div>
                    <div class="x-column x-sm x-1-4">
                        <label for="shelter_state"><?php _e('State', 'catspride'); ?> <span
                                    class="required">*</span></label>
                        <select class="catspride-Input catspride-Input--select input-select" name="shelter_state"
                                id="shelter_state">
                            <option value="">Choose a State...</option>
                            <?php foreach ($default_county_states as $state_abbr => $state) { ?>
                                <option value="<?php echo $state_abbr; ?>" <?php selected(((isset($_POST['shelter_state'])) ? esc_attr($_POST['shelter_state']) : ''), $state_abbr) ?>><?php echo $state_abbr ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="x-container">
                    <label for="shelter_website"><?php _e('Website', 'catspride'); ?> <span
                                class="required">*</span></label>
                    <input type="text" class="catspride-Input catspride-Input--text input-text" name="shelter_website"
                        id="shelter_website" placeholder="http://"
                        value="<?php echo (isset($_POST['shelter_website'])) ? esc_url($_POST['shelter_website']) : ''; ?>"/>
                </div>

                <?php do_action('catspride_nominate_shelter_form'); ?>

               
                <div class="x-container button-wrapper">
                    <?php wp_nonce_field('catspride-nominate_shelter'); ?>
                    <a href="<?php echo wc_get_page_permalink('myaccount'); ?>" class='primary-button--purple' title="Return to My Account" style="margin-right:15px;">cancel</a>
                    <?php if ( is_array( $cp_shelters ) && count( $cp_shelters ) > 0 ) { ?>
                        <input type="submit" class="catspride-Button primary-button--blue" name="nominate_shelter"
                            value="<?php esc_attr_e('Continue Nomination', 'catspride'); ?>"/>
                        <input type="hidden" name="force_nomination" value="1"/>
                    <?php } else { ?>
                        <input type="submit" class="catspride-Button primary-button--blue" name="nominate_shelter"
                            value="<?php esc_attr_e('Nominate', 'catspride'); ?>"/>
                    <?php } ?>
                    <input type="hidden" name="action" value="nominate_shelter"/>
                </div>

                <?php do_action('catspride_nominate_shelter_form_end'); ?>
            </form>

        </div>

    </div>
</div>

<?php do_action('catspride_after_nominate_shelter_form'); ?>

<?php add_action('wp_footer', function() { ?>

    <?php include( 'partials/partial-choose-shelter-modal.php' ); ?>

<?php }); ?>
