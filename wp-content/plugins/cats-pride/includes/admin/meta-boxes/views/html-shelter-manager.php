<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="inside cp-meta-box-shelter_manager">

    <?php

    $invite_sent   = ( get_post_meta( $post->ID, '_cp_invite_email_sent', true) !== '' );
    $has_email     = ( get_post_meta( $post->ID, 'email', true) !== '');
    $has_manager   = ( cp_get_shelter_manager_id( $post->ID ) );
    $shelter_token = cp_get_token_by_shelter_id( $post->ID );

    ?>

    <table style="width:100%;">

    <tr>
        <td style="font-weight:bold;">Total Nominations</td>
        <td><?php echo cp_get_shelter_nomination_count( $post->ID ); ?></td>
    </tr>

    <?php

    $is_nominated = get_post_meta( $post->ID, '_cp_nominated_by_user', true);

    if ( !empty( $is_nominated ) ) {

        $nominating_user = get_user_by('ID', $is_nominated );

    ?>

    <tr>
        <td colspan="2">
            <span style="font-weight:bold;">Submitted By User</span>
            <p style="text-align:right;"><?php echo $nominating_user->user_email; ?></p>
        </td>
    </tr>

    <?php } else { ?>

        <tr>
            <td style="font-weight:bold;">Submitted By User</td>
            <td>No</td>
        </tr>

    <?php } ?>

    <?php

    $is_direct_registration = get_post_meta( $post->ID, '_cp_new_shelter', true ); ?>

    <tr>
        <td style="font-weight:bold;">Direct Registration</td>
        <td><?php echo ( !empty( $is_direct_registration ) ? 'Yes' : 'No' ) ?></td>
    </tr>

    </table>

    <?php

    /*
     * If the shelter has an assigned manager, show their details in the Shelter Manager box.
     */
    if ( $has_manager ) {

        $shelter_manager_id = cp_get_shelter_manager_id($post->ID);
        $shelter_manager = get_user_by('ID', $shelter_manager_id);

    ?>

        <p><?php _e('Below is the assigned manager for this shelter. This manager has access to shelter resources and has the ability to edit the shelter details.', 'catspride'); ?></p>
        <span><?php _e('Shelter Manager', 'catspride'); ?>
            <a href="<?php echo get_edit_user_link($shelter_manager_id); ?>"><?php echo $shelter_manager->user_email; ?></a>
        </span>

    <?php } ?>

    <?php

    /*
     * If the post is approved, but a manager is not yet set, and there is an email. Allow the admin
     * the ability to manually trigger an invite send to the email defined.
     */
    if ( $post->post_status === 'draft' && !$has_manager && $has_email ) { ?>

        <p><?php _e( 'Send the shelter an invitation email to register their account and manage their shelter\'s profile.', 'catspride' ); ?></p>
        <input type="submit" class="button" name="force_send_shelter_invite" value="<?php _e( sprintf('%s Shelter Invite', ( $invite_sent ? 'Re-send' : 'Send') ), 'catspride' ); ?>">

    <?php }

    /*
     * If the post is pending and has not yet been approved by Cat's Pride, display a button
     * that they can click to approve it and send out the shelter email.
     */
    if ( in_array( $post->post_status, [ 'pending' ] ) && !$has_manager && $has_email ) { ?>

        <p><?php _e('If you choose to Send Notifications, the shelter will be emailed a link that will direct them to register.<br/><br/>After they complete registration, their shelter will be published and available for nomination.', 'catspride'); ?></p>
        <input type="checkbox" id="approve_send_notifications" name="send_notifications" checked="checked" value="1" />
        <label style="font-weight:bold;" for="approve_send_notifications"><?php _e( 'Send Notifications', 'catspride' ); ?></label><br /><br />
        <input type="submit" class="button" name="save_shelter_as_draft" value="<?php _e( 'Save as Approved', 'catspride' ); ?>" />

    <?php } else if ( $post->post_status === 'publish' && !$has_manager && $has_email ) { ?>

        <p><?php _e( 'The shelter is published, but does not have a shelter manager. It must be set to pending in order to send an invite to the shelter contact.', 'catspride' ); ?></p>

    <?php }

    /*
     * If there isn't an email set for the shelter, and they don't have a manager, they must set one.
     */
    if ( !$has_email ) { ?>

        <p><?php _e( 'You must have an email set for the shelter in order to send out an invite for a shelter manager to claim their profile.', 'catspride' ); ?></p>

    <?php }

    if ( $shelter_token ) {

        $registration_url  = add_query_arg( array (
            'cp_st' => $shelter_token,
            'tab'   => 'register'
        ), wc_get_page_permalink( 'myaccount' ) );

        ?>

        <label style="font-weight: bold;margin-top:20px;margin-bottom: 5px;display: block;">Shelter PURL</label>
        <textarea style="width:100%;height:80px;" readonly><?php echo $registration_url; ?></textarea>

    <?php } ?>

    <?php if ( in_array( $post->post_status, [ 'pending', 'draft'] ) ) { ?>

        <div class="cp-shelter-rejected-wrapper" style="padding: 15px;background: #f1f1f1;margin-top: 20px;">
            <label style="font-weight: bold;margin-bottom: 5px;display: block;">Save as Rejected</label>
            <p>By rejecting this shelter, it will be sent to the trash. This ensures that future nominations are flagged as an already existing submission and won't require review again.</p>
            <label style="font-weight: bold;margin-top:20px;margin-bottom: 5px;display: block;">Rejection Reason<span class="required">*</span></label>
            <select id="cp_shelter_rejection_reason" name="cp_shelter_rejection_reason">
                <option value="">Choose a Reason...</option>
                <option value="duplicate">Duplicate</option>
                <option value="no_contact">No Contact Found</option>
                <option value="vet">Vet Clinic</option>
            </select>
            <div id="cp-shelter-duplicate-additional-fields" style="display:none;">
                <label style="font-weight: bold;margin-top:20px;margin-bottom: 5px;display: block;">Enter Existing Shelter ID <span class="required">*</span></label>
                <p>Please note, by marking this shelter as a duplicate, any nominations for this shelter will be re-assigned to the shelter ID defined below:</p>
                <input type="number" name="cp_duplicate_shelter_id" value="">
            </div>
            <br><br>
            <input type="checkbox" id="reject_send_notifications" name="send_notifications" checked="checked" value="1" />
            <label style="font-weight:bold;" for="reject_send_notifications"><?php _e( 'Send Notifications', 'catspride' ); ?></label><br /><br />
            <input type="submit" class="button" name="save_shelter_as_trash" value="<?php _e( 'Reject Shelter', 'catspride' ); ?>">
        </div>

        <script type="text/javascript">
            jQuery('#cp_shelter_rejection_reason').change(function() {
               if ( jQuery(this).val() === 'duplicate') {
                   jQuery('#cp-shelter-duplicate-additional-fields').show();
               } else {
                   jQuery('#cp-shelter-duplicate-additional-fields').hide();
               }
            });
        </script>

    <?php } ?>

	<?php wp_nonce_field( 'catspride_save_data', 'catspride_meta_nonce' ); ?>
    <div class="clear"></div>
</div>