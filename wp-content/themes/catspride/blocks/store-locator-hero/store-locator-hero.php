<?php
/*
* Block Name: Store Locator Hero
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $title = get_field('title');
    $subtitle = get_field('subtitle');
    $following_text = get_field('following_text');
    $image = get_field('image');
    $background_color = get_field('background_color');
    $icon_color = get_field('icon_color');


endif; ?>
<section class="store-locator-hero" style='background-color:<?php echo $background_color; ?>'>
    <div class="container">
        <div class="store-locator-hero__inner">
            <div class="store-locator-hero__items row <?php if ($following_text) : echo 'store-locator-hero__items-with-text'; endif; ?>">
                <div class="store-locator-hero__left col-lg-6">

                    <div class="store-locator-hero__left-text-wrapper">
                        <i class="fa-solid fa-quote-left" style="color: <?php echo $icon_color; ?>; background-color:<?php echo $background_color; ?>"></i>
                        <?php if ($title): ?>

                            <h1 class="title-primary"><?php echo $title; ?></h1>

                        <?php endif; ?>

                        <?php if ($subtitle): ?>

                            <h3 class="title-third"><?php echo $subtitle; ?></h3>

                        <?php endif; ?>
                        <i class="fa-solid fa-quote-right" style="color: <?php echo $icon_color; ?>; background-color:<?php echo $background_color; ?>"></i>
                    </div>

                    <?php if ($following_text) : ?>
                        <div class="store-locator-hero__left-following-text">
                            <?php echo $following_text; ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="store-locator-hero__right col-lg-6">

                    <?php if ($image): ?>

                        <div class="store-locator-hero__image">
                            <?php echo wp_get_attachment_image($image, 'medium');  ?>
                        </div>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>