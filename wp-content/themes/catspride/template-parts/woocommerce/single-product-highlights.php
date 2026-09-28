<?php

$selector = $args['style'] === 'highlights_dfu' ? '_dfu' : '';

$title = get_field('product_highlights_title' . $selector, get_the_ID());
$productHighlights = get_field('product_highlights' . $selector, get_the_ID());
$primaryColor = get_field('primary_color' . $selector, get_the_ID());
$secondaryColor = get_field('secondary_color' . $selector, get_the_ID());
$disclaimer = get_field('product_highlights_disclaimer' . $selector, get_the_ID());
if(!$productHighlights) return;
?>

<section class="product-highlights <?php if ($selector === "_dfu") echo "product-highlights" . $selector;?>" style="background-color: <?php echo $primaryColor; ?>;">
    <div class="container">
        <div class="product-highlights__inner">

            <?php if ($title): ?>

                <h2 class="title-secondary"><?php echo $title; ?></h2>

            <?php endif; ?>

            <?php if ($productHighlights): ?>

                <div class="product-highlights__items row">

                    <?php foreach ($productHighlights as $productHighlight): ?>

                        <div class="product-highlights__item col-md-3">

                            <?php if ($productHighlight['image']): ?>

                                <div class="product-highlights__image">
                                    <?php echo wp_get_attachment_image($productHighlight['image'], 'medium');  ?>
                                </div>

                            <?php endif; ?>

                            <?php if ($productHighlight['title']): ?>

                                <h3 class="title-third"><?php echo $productHighlight['title']; ?></h3>

                            <?php endif; ?>

                            <?php if ($productHighlight['description']): ?>

                                <div class="product-highlights__description">
                                    <?php echo $productHighlight['description']; ?>
                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php if($disclaimer): ?>

<p style="background-color: <?php echo $secondaryColor; ?>;" class="product-highlights-info <?php if ($selector === "_dfu") echo "product-highlights-info" . $selector;?>"><?php echo $disclaimer; ?></p>

<?php endif; ?>