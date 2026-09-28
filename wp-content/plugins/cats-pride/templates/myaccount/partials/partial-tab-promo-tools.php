<div class="x-column x-sm x-2-3 last s-12 mobile-s-18" style="line-height: normal;">
<?php
$content = get_field( 'content_sections', get_the_id() );

foreach( $content as $section ) {
    /*
     *
     * Header Sections
     *
     */
    if ( $section['acf_fc_layout'] === 'header' ) {

        $header_class = 'h-custom-headline';

        if ( $section['type'] === 'header' ) {

            $header_class .= ' cp-fc-header-header';

        } else if ( $section['type'] === 'sub_header_1' ) {

            $header_class .= ' cp-fc-header-sub_header_1';

        } else if ( $section['type'] === 'sub_header_2' ) {

            $header_class .= ' cp-fc-header-sub_header_2';

        }

        echo '<h3 class="' . $header_class . ' mobile-s-20 mobile-mbs">' . $section['title'] .  '</h3>';

        /*
         *
         * Text Section
         *
         */
    } else if ( $section['acf_fc_layout'] === 'text_content' ) {

        echo '<div class="x-section cp-acf-text_content mobile-ptn">';

        echo '<div class="cp-fc-text">' . $section['text'] . '</div>';

        echo '</div>';

        /*
         *
         * File Download Section
         *
         */
    } else if ( $section['acf_fc_layout'] === 'file_download' ) {

        echo '<div class="x-section cp-acf-file_download">';

        echo '<h4 class="h-custom-headline cp-fc-header-sub_header_2 mobile-s-15">' . $section['header'] .  '</h4>';

        echo '<div class="cp-fc-text mobile-mbl">' . $section['text'] . '</div>';

        echo '<div class="button-holder mobile-center-text"><a href="' . cp_get_download_tracking_url( $section['file']['url'] ) . '" class="x-btn blue-alt x-btn-global s-16 primary-button--light-blue" target="_blank">' . $section['button'] . '</a>';

        if ( isset( $section['file']['filesize'] ) ) {

            echo '<span class="cp-fc-file-size s-12 mobile-s-14">' . (($section['file']['filesize'] > 50000000) ? 'Large file<span class="separator">|</span>' : '' ) . size_format( $section['file']['filesize'], 2 ) . '</span>';

        }

        echo '</div></div>';

        /*
         *
         * Assets Download Section
         *
         */
    } else if ( $section['acf_fc_layout'] === 'asset_downloads' ) {

        echo '<div class="x-section cp-acf-asset_downloads row">';

        echo '<div class="x-column x-sm x-1-4 mobile-center-text col-md-3">';

        if( !empty( $section['thumbnail'] ) ) {
            echo '<img src="' . $section['thumbnail'] . '" alt="' . $section['header'] . '" class="cp-fc-thumbnail" />';
        }

        echo '</div>';


        echo '<div class="x-column x-sm x-3-4 mobile-center-text col-md-9">';

        echo '<h4 class="s-18 mobile-s-16 mobile-mtl mobile-mbm" style="padding-bottom:4px;margin-bottom:20px;border-bottom: solid 2px #e6e6e6;">' . $section['header'] .  '</h4>';

        if ( isset( $section['text'] ) && !empty( $section['text']) ) {

            echo '<div class="cp-fc-text">' . $section['text'] . '</div>';

        }

        if ( count( $section['assets'] ) > 0 ) {

            echo '<ul class="cp-cf-section-assets-list">';

            foreach( $section['assets'] as $asset ) {

                echo '<li >';

                //echo do_shortcode('[x_icon type="' . $asset['icon'] . '"]');

                echo '<div class="button-holder mobile-center-text"><a href="' . cp_get_download_tracking_url( $asset['file']['url'] ) . '" title="' . $asset['title'] . '" target="_blank" class="x-btn blue-alt x-btn-global s-16 primary-button--light-blue">' . $asset['title'];
                echo '</a>';

                if (isset($asset['file']['filesize'])) {

                    if (isset($asset['file']['width']) && isset($asset['file']['height'])) {
                        //echo '<span class="separator">|</span>';
                        //echo '<span class="cp-fc-file-dimensions">' . $asset['file']['width'] . ' x ' . $asset['file']['height'] . 'px </span>';
                    }

                    //echo '<span class="separator">|</span>';
                    echo '<span class="cp-fc-file-size s-12 mobile-s-14">' . size_format( $asset['file']['filesize'], 2 ) . '</span>';

                }


                echo '</div></li>';

            }

            echo '</ul>';

        }

        echo '</div>';

        echo '</div>';

    }

}

?>
</div>