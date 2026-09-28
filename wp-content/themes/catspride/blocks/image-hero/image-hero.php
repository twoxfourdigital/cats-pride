<?php
/*
* Block Name: Image Hero
* Post Type: page
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $desktopImage = get_field('desktop_image');
    $mobileImage  = get_field('mobile_image');
    $link         = get_field('link');

    // Use desktop image as the default <img>, fall back to mobile if missing.
    $mainImage = $desktopImage ?: $mobileImage;

    // Wrap the whole section in an <a> when a link is set, otherwise a <div>.
    $tag        = $link ? 'a' : 'div';
    $linkAttrs  = '';
    if ($link) :
        $linkAttrs .= ' href="' . esc_url($link['url']) . '"';
        if (!empty($link['target'])) :
            $linkAttrs .= ' target="' . esc_attr($link['target']) . '" rel="noopener"';
        endif;
    endif;
?>

    <section class="image-hero container">
        <<?php echo $tag; ?> class="image-hero__inner"<?php echo $linkAttrs; ?>>
            <?php if ($mainImage): ?>
                <picture>
                    <?php if ($mobileImage): ?>
                        <source media="(max-width: 1024px)" srcset="<?php echo esc_url(wp_get_attachment_image_url($mobileImage, 'full')); ?>">
                    <?php endif; ?>
                    <?php echo wp_get_attachment_image($mainImage, 'full', false, array('class' => 'image-hero__image')); ?>
                </picture>
            <?php endif; ?>
        </<?php echo $tag; ?>>
    </section><!-- .image-hero-->

<?php endif; ?>
