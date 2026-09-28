<?php
/**
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * CP_Admin_Users.
 */
class CP_Admin_Users {

    /**
     * Constructor.
     */
    public function __construct() {

        add_action( 'show_user_profile', array( $this, 'show_extra_profile_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'show_extra_profile_fields' ) );

        add_action( 'user_profile_update_errors', array( $this, 'validate_extra_profile_fields' ) );
        add_action( 'personal_options_update', array( $this, 'save_extra_profile_fields' ) );
        add_action( 'edit_user_profile_update', array( $this, 'save_extra_profile_fields' ) );

    }

    /**
     * @param $user_id
     * @return bool
     */
    public function save_extra_profile_fields( $user_id ) {

        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;

        if ( !isset( $_POST['manage_shelter_id'] ) || empty( $_POST['manage_shelter_id'] ) ) {
            cp_remove_user_as_shelter_manager( $user_id );
        } else {
            $manage_shelter = get_post( (int) $_POST['manage_shelter_id'] );
            if ( $manage_shelter && $manage_shelter->post_status === 'publish' && $manage_shelter->post_type === 'cp_shelter') {
                $set_shelter_manager = cp_set_user_as_shelter_manager( $user_id, $_POST['manage_shelter_id'] );
            }
        }

        // We will automatically be setting a new nomination for the user if they were set as a shelter manager above
        if ( !isset( $set_shelter_manager ) && ( !isset( $_POST['nominate_shelter_id'] ) || empty( $_POST['nominate_shelter_id'] ) ) ) {

            // Update the current nomination and set the active_end to now
            cp_end_current_shelter_nomination_for_user( $user_id );

        } else if ( isset( $_POST['nominate_shelter_id'] ) && !empty( $_POST['nominate_shelter_id'] ) ) {

            $nominate_shelter = get_post( (int) $_POST['nominate_shelter_id'] );

            if ( $nominate_shelter && $nominate_shelter->post_status === 'publish' && $nominate_shelter->post_type === 'cp_shelter') {
                cp_insert_user_shelter_nomination( $user_id, $_POST['nominate_shelter_id'] );
            }

        }

    }

    /**
     * @param $errors
     * @param null $update
     * @param null $user
     */
    public function validate_extra_profile_fields($errors, $update = null, $user  = null)
    {

        if ( isset( $_POST['manage_shelter_id'] ) && !empty( $_POST['manage_shelter_id'] ) ) {
            $manage_shelter = get_post( (int) $_POST['manage_shelter_id'] );
            if ( ! ( $manage_shelter && $manage_shelter->post_status === 'publish' && $manage_shelter->post_type === 'cp_shelter' ) ) {
                $errors->add('invalid_manage_shelter', "<strong>ERROR</strong>: Invalid manage shelter ID provided. Shelter must be published and ID provided must be for a shelter.");
            }
        }

        if ( isset( $_POST['nominate_shelter_id'] ) && !empty( $_POST['nominate_shelter_id'] ) ) {
            $nominate_shelter = get_post( (int) $_POST['nominate_shelter_id'] );
            if ( ! ( $nominate_shelter && $nominate_shelter->post_status === 'publish' && $nominate_shelter->post_type === 'cp_shelter' ) ) {
                $errors->add('invalid_nominate_shelter', "<strong>ERROR</strong>: Invalid nominate shelter ID provided. Shelter must be published and ID provided must be for a shelter.");
            }
        }
    }

    /**
     * @param $user
     */
    public function show_extra_profile_fields( $user )
    {

        $user_actions      = cp_get_logs( null, $object_type = 'user', $object_type_id = $user->ID );
        $manage_shelter_id = cp_get_shelter_by_manager_id( $user->ID );
        $nomination        = cp_get_current_shelter_nomination_for_user( $user->ID );

        $nominate_shelter_id = ( $nomination ) ? $nominate_shelter_id = $nomination->shelter_post_id : null;

        if ( $manage_shelter_id )
            $manage_shelter   = get_post( $manage_shelter_id );

        if ( $nominate_shelter_id )
            $nominate_shelter = get_post( $nominate_shelter_id );

        ?>

        <h3>Shelter Information</h3>
        <table class="form-table">
            <?php if( in_array( 'shelter_manager', $user->roles ) ) { ?>
            <tr>
                <th><label for="manage_shelter_id"><?php _e('Manage Shelter', 'catspride'); ?></label></th>
                <td>
                    <?php

                    if ( $manage_shelter_id && $manage_shelter) {
                        echo '<span>' . $manage_shelter->post_title . '</span><br>';
                        echo '<input type="text" name="manage_shelter_id" value="' . $manage_shelter_id . '" /><br>';
                    } else {
                        echo '<span style="font-style: italic;">' . __( 'None Selected', 'catspride' ) . '</span><br>';
                        echo '<input type="text" name="manage_shelter_id" value="' . $manage_shelter_id . '" /><br>';
                    }
                    echo '<span class="description">' . __( 'Enter a shelter ID to assign this user as a manager.', 'catspride' ) . '</span>';

                    ?>
                </td>
            </tr>
        <?php } ?>
            <tr>
                <th><label for="nominate_shelter_id"><?php _e('Nominate Shelter', 'catspride'); ?></label></th>
                <td>
                    <?php

                    if ( $nominate_shelter_id && $nominate_shelter) {
                        echo '<span>' . $nominate_shelter->post_title . '</span><br>';
                        echo '<input type="text" name="nominate_shelter_id" value="' . $nominate_shelter_id . '" /><br>';
                    } else {
                        echo '<span style="font-style: italic;">' . __( 'None Selected', 'catspride' ) . '</span><br>';
                        echo '<input type="text" name="nominate_shelter_id" value="' . $nominate_shelter_id . '" /><br>';
                    }
                    echo '<span class="description">' . __( 'Enter a shelter ID to assign it as the user\'s nomination.', 'catspride' ) . '</span>';

                    ?>
                </td>
            </tr>
        </table>

        <h3>User Account Log</h3>
        <div class="line-numbers">
        <pre><?php

            $line = 1;

            $user_action_users = [];

            if($user_actions && count($user_actions) > 0) {

                foreach($user_actions as $action) {

                    $context = maybe_unserialize( $action['log_context'] );
                    $performed_by = 'N/A';

                    if ( isset( $context['performed_by_user_id'] ) && is_numeric( $context['performed_by_user_id'] ) ) {

                        if ( isset( $user_action_users[ $context['performed_by_user_id'] ] ) && isset( $user_action_users[ $context['performed_by_user_id'] ]->user_email ) ) {
                            $performed_by = $user_action_users[ $context['performed_by_user_id'] ]->user_email;
                        }
                        $user_action_users[ $context['performed_by_user_id'] ] = get_user_by( 'ID', $context['performed_by_user_id']);
                        $performed_by = $user_action_users[ $context['performed_by_user_id'] ]->user_email;
                    }

                    echo '<p><span class="line-number">'.$line.'</span>' . $action['log_timestamp'] . ' [' . $performed_by . ']: ' . $action['log_message'] . '</p>';
                    $line++;

                }

            } else {

                echo "<p><span class='line-number'>".$line++."</span>There have not been any actions taken by the user that would require a log to be added.</p>";


            }

            ?></pre>
        </div>


        <?php

    }

}

new CP_Admin_Users();
