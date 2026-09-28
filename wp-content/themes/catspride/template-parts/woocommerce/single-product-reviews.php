<?php
$reviewLinks = $args['reviewLinks'];
$externalID = $args['externalID'];
if(!$externalID) return;
?>

<div class="reviews-container" id="reviews-container">
   <?php echo $reviewLinks; ?>
    <div id="rr">
        <div data-bv-show="reviews" data-bv-product-id="<?php echo $externalID; ?>"></div>
    </div>
</div>
