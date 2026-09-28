<div id="catspride-ChooseShelterModal" class="cp-modal-wrapper">
    <div class="cp-modal-inner-wrapper">
        <div class="cp-modal-header">
        </div>
        <div class="cp-modal-body">
            <p>Thanks for nominating<br><strong><span class="cp-chosen-shelter-name">SHELTER NAME</span>!</strong></p>
            <p class="cp-chosen-shelter-location">City, State</p>
            <span class="cp-bonus-code-prompt cp-bonus-code-off">
                    Have a bonus code?
                </span>
            <input type="text" name="bonus_code" class="cp-bonus-code-input cp-bonus-code-on" placeholder="Enter Bonus Code" />
            <p class="cp-modal-error-message cp-modal-message"></p>
        </div>
        <div class="cp-modal-footer">
            <p class="cp-modal-success-message cp-modal-message"></p>
            <input type="submit" class="x-btn blue-rev cp-modal-submit" value="<?php esc_attr_e( 'Submit', 'catspride' ); ?>" />
            <input type="submit" class="x-btn blue-rev cp-modal-continue" value="<?php esc_attr_e( 'Continue', 'catspride' ); ?>" />
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="cp-modal-loader"><circle cx="50" cy="50" fill="none" stroke-linecap="round" r="40" stroke-width="5" stroke="#f7f7f7" stroke-dasharray="62.83185307179586 62.83185307179586" transform="rotate(267.5 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="2.4s" begin="0s" repeatCount="indefinite"></animateTransform></circle><circle cx="50" cy="50" fill="none" stroke-linecap="round" r="34" stroke-width="5" stroke="#dbdbdb" stroke-dasharray="53.40707511102649 53.40707511102649" stroke-dashoffset="53.40707511102649" transform="rotate(-267.5 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-360 50 50" keyTimes="0;1" dur="2.4s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg>
            <span class="cp-continue-without-bonus-code cp-bonus-code-on"><?php _e( 'Continue without bonus code.', 'catspride' ); ?></span>
            <div class="clear"></div>
        </div>

        <form id="catspride-ChooseShelterForm" class="catspride-ChooseShelterForm choose-shelter" style="display:none;">
            <?php wp_nonce_field('catspride-choose_shelter'); ?>
            <input id="input-choose-shelter-bonus_code" type="hidden" name="bonus_code" value=""/>
            <input id="input-choose-shelter-favorite_shelter" type="hidden" name="favorite_shelter" value=""/>
            <input id="input-choose-shelter-action" type="hidden" name="action" value="cp_update_nomination"/>
        </form>

    </div>
</div>