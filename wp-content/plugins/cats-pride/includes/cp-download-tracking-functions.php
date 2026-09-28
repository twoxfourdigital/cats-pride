<?php

/**
 *
 */
function cp_track_file_download()
{
   if ( isset( $_GET['cp_tfd'] ) ) {

       $url       = parse_url( $_GET['url'] );
       $file_path = ABSPATH . ltrim( $url['path'], '/' );

       if ( file_exists( $file_path ) && cp_is_file_download_allowed( $url['path'] ) ) {

           if ( is_user_logged_in() ) {

               $user = wp_get_current_user();

               if ($user) {

                   $shelter_id = cp_get_shelter_by_manager_id( $user->ID );

                   if ( $shelter_id ) {

                       // Store a meta entry for the shelter marking that they have downloaded a particular file.
                       update_post_meta( $shelter_id, '_cp_file_downloaded', date('Y-m-d' ) );

                       /**
                        * @var $logger CP_Logger
                        */
                       $logger = cp_get_logger();

                       $logger->info(
                           'File downloaded: ' . $_GET['url'],
                           [
                               'params' => [
                                   'url' => $_GET['url']
                               ]
                           ],
                           'shelter_account',
                           'cp_shelter',
                           $shelter_id
                       );

                   }

               }

           }

           cp_trigger_download( $file_path );

       }

   }

}

add_action( 'wp_loaded', 'cp_track_file_download' );

/**
 * @param $url
 * @return string
 */
function cp_get_download_tracking_url( $url ) {

    $download_tracking_url = add_query_arg( [
        'cp_tfd' => 1,
        'url' => urlencode( $url )
    ], home_url() );

    return $download_tracking_url;

}

/**
 * @param $file_path
 */
function cp_trigger_download( $file_path )
{
    $file_type = wp_check_filetype( $file_path );
    $file_name = basename( $file_path );

    header("Content-type: " . $file_type['type'] );
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-length: " . filesize($file_path));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile( $file_path );

    exit;

}

/**
 *
 * We want to ensure that the only files being allowed for download are within the /wp-content/uploads directory.
 *
 * @param $relative_file_path
 * @return bool
 */
function cp_is_file_download_allowed( $relative_file_path )
{
    if ( strpos( $relative_file_path, '/wp-content/uploads/' ) === 0 ) {
        return true;
    }
    return false;
}