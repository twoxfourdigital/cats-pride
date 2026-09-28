<?php
/*
* Block Name: Store Locator
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $description = get_field('description');
    $shortcode = get_field('shortcode');
?>

    <section class="store-locator">
        <div class="container">
            <div class="store-locator__inner">
                <?php if ($description) : ?>
                    <p class="store-locator-description"><?php echo $description; ?></p>
                <?php endif; ?>

                <?php if ($shortcode) :
                    echo do_shortcode($shortcode);
                endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>