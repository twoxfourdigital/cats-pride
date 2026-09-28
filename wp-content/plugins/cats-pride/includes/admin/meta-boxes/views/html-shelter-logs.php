<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="inside cp-meta-box-shelter_logs">

    <div class="line-numbers">
        <pre><?php

            $line = 1;

            $user_action_users = [];

            if( isset($shelter_logs) && $shelter_logs && count($shelter_logs) > 0) {

                foreach($shelter_logs as $action) {

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

                echo "<p><span class='line-number'>".$line++."</span>There have not been any actions taken by the shelter that would require a log to be added.</p>";


            }

            ?></pre>
    </div>

</div>