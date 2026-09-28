<h1><?php _e( 'Reports', 'catspride' ); ?></h1>

<?php if ( !isset( $reports ) || !$reports || count( $reports ) === 0 ) { return; } ?>

<?php

$columns       = 4;
$total_reports = count( $reports );
$loop          = 0;

?>

<div id="cp-admin-container" class="container-fluid">

    <?php

    if ( wc_notice_count() > 0 ) {
        wc_print_notices();
    }

    foreach ( $reports as $report_id => $report ) { ?>

        <?php if ( $loop === 0 ) { ?>
            <div class="row">
        <?php } ?>

        <div class="col">
            <div id="report-container_<?php echo $report_id;?>" class="postbox">
                <h2>
                    <span><?php echo $report['title']; ?></span>
                </h2>
                <div class="inside">
                    <?php include_once( dirname( __FILE__ ) . '/reports/admin-report-' . $report_id . '.php'); ?>
                </div>
            </div>
        </div>

        <?php

        $loop++;
        $total_reports--;

        ?>

        <?php if ( $total_reports === 0 || $loop % $columns === 0 ) { ?>

            <?php $loop = 0; ?>

            </div>

        <?php } ?>

    <?php } ?>


</div>
