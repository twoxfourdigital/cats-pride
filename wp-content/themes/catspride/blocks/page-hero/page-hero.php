<?php
/*
* Block Name: Page Hero
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    if (is_home()):
        $background = get_field('blog_hero_background', 'options');
        $description = get_field('blog_hero_description', 'options');
        $boxColor = get_field('blog_hero_box_color', 'options');
        $boxFontColor = get_field('blog_hero_box_font_color', 'options');

    else:
        $background = get_field('background');
        $description = get_field('description');
        $boxColor = get_field('box_color');
        $boxFontColor = get_field('box_font_color');
    endif;
?>

    <section class="page-hero" <?php if ($background) echo 'style=background-image:url(' . wp_get_attachment_url($background) . ');'; ?>>
        <div class="page-hero__box" <?php if ($boxColor) echo 'style=background-color:' . $boxColor . ';'; ?>>
            <?php if ($description): ?>
                <p class="page-hero__description" <?php if ($boxFontColor) echo 'style=color:' . $boxFontColor . ';'; ?>><?php echo $description; ?></p>
            <?php endif; ?>
        </div>
    </section><!-- .page-hero-->

<?php endif; ?>