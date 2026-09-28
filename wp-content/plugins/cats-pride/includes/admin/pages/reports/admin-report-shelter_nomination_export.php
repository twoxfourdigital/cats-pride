<?php

$start_date = ( isset( $_POST['shelter_nomination_export_start_date'] ) && !empty( $_POST['shelter_nomination_export_start_date'] ) ) ? date( 'Y-m-d', strtotime( $_POST['shelter_nomination_export_start_date'] ) ) : date('Y-m-d');
$end_date   = ( isset( $_POST['shelter_nomination_export_end_date'] ) && !empty( $_POST['shelter_nomination_export_end_date'] ) ) ? date( 'Y-m-d', strtotime( $_POST['shelter_nomination_export_end_date'] ) ) : date('Y-m-d');

?>

<p class="desc">This report allows you to export all of the shelter nominations. This is useful if you would like to view the total nominations for each shelter during a period of time.</p>

<form name="shelter_nomination_export" method="POST" action="<?php echo admin_url( 'admin.php?page=cp-admin-page-reporting' ); ?>">

    <label for="shelter_nomination_export_start_date">Start Date</label>
    <input id="shelter_nomination_export_start_date" type="date" name="shelter_nomination_export_start_date" value="<?php echo $start_date; ?>" />
    <label for="shelter_nomination_export_end_date">End Date</label>
    <input id="shelter_nomination_export_end_date" type="date" name="shelter_nomination_export_end_date" value="<?php echo $end_date; ?>" />

    <?php wp_nonce_field('shelter_nomination_export'); ?>

    <input type="hidden" name="action" value="report_shelter_nomination_export">

    <button type="submit" class="button button-primary button-large right">Download Report</button>

</form>