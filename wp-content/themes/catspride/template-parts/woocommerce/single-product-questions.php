<?php
$externalID = $args['externalID'];
if(!$externalID) return;
?>

<div id="qa">
    <div data-bv-show="questions" data-bv-product-id="<?php echo $externalID; ?>"></div>
</div>