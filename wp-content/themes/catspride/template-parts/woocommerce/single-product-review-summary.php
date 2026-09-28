<?php
$externalID = $args['externalID'];
if(!$externalID) return;
if ($externalID) { ?>

    <div class="reviews-wrapper-summary" id="reviews-wrapper-summary">
        <div data-bv-show="rating_summary" data-bv-product-id="<?php echo $externalID; ?>"></div>
    </div>

<?php }
