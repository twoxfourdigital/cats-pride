<?php if ( $orientation === "horizontal" ) : ?>

    <?php if ( $show_title === true ) : ?>
        <div class="x-sm x-column x-1-3 buy-online buy-online-heading horizontal mobile-mbl" style="padding: 0px;">
            <h2 class="h-custom-headline man h3">
                <span><?php _e('<strong>Buy</strong> Online', 'catspride'); ?></span>
            </h2>
        </div>
    <?php endif; ?>
    <?php if ( count( $purchase_links ) > 0 ) { ?>
        <div class="x-sm x-column x-2-3 buy-online buy-online-buttons horizontal <?php echo esc_attr( $buttons_class ); ?>" style="">
            <?php

            $total_links = count( $purchase_links );

            if ( $total_links === 1) {
                $class = 'x-1-1';
            } else if ( $total_links === 2) {
                $class = 'x-1-2';
            } else {
                $class = 'x-1-3';
            }

            foreach( $purchase_links as $link ) { ?>
                <div class="x-column x-sm x-1-3 center-text cp-purchase-link cp-purchase-link-<?php echo esc_attr( $link[ 'name' ] ); ?> mobile-mbl">
                    <a id="cp-purchase-link-<?php echo esc_attr( $link[ 'name' ] ); ?>" class="cp-purchase-link-<?php echo esc_attr( $link[ 'name' ] ); ?> <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_attr( $link[ 'url' ] ); ?>" data-options="thumbnail: ''" target="_blank">
                        <span class="icon-<?php echo esc_attr( $link[ 'name' ] ); ?>"></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

<?php else : ?>

    <?php if ( $show_title === true ) : ?>
        <div class="x-sm pam x-1-1 <?php echo esc_attr( $header_column_class ); ?> buy-online buy-online-heading" style="padding: 0px;">
            <h2 class="h-custom-headline cs-ta-center w-700 <?php echo esc_attr( $header_class ); ?> man h3">
                <span><?php _e('Buy Online', 'catspride'); ?></span>
            </h2>
        </div>
    <?php endif; ?>
    <?php if ( count( $purchase_links ) > 0 ) { ?> 
        <div class="x-sm x-1-1 buy-online buy-online-buttons <?php echo esc_attr( $buttons_class ); ?>" style="margin: 20px auto 0px;padding: 0px;">
            <?php

            $total_links = count( $purchase_links );

            if ( $total_links === 1) {
                $class = 'x-1-1';
            } else if ( $total_links === 2) {
                $class = 'x-1-2';
            } else {
                $class = 'x-1-3';
            }

            foreach( $purchase_links as $link ) { ?>
                <div class="x-column x-sm x-1-3 center-text cp-purchase-link cp-purchase-link-<?php echo esc_attr( $link[ 'name' ] ); ?> mobile-mbl">
                    <a id="cp-purchase-link-<?php echo esc_attr( $link[ 'name' ] ); ?>" class="x-btn x-btn-global <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_attr( $link[ 'url' ] ); ?>" data-options="thumbnail: ''" target="_blank">
                        <span class="icon-<?php echo esc_attr( $link[ 'name' ] ); ?>"></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

<?php endif; ?>
