<?php
$id = get_the_ID();

$attributes = [
    'pa_sizes'  => [
        'label' => esc_html__('Available sizes', 'cats-pride'),
        'info'  => esc_html__('Weight in lbs', 'cats-pride'),
    ],
    'pa_liners' => [
        'label' => esc_html__('Liner Size', 'cats-pride'),
        'info'  => '',
    ],
    'pa_count'  => [
        'label' => esc_html__('Box Count', 'cats-pride'),
        'info'  => '',
    ],
];

foreach ($attributes as $taxonomy => $labels):
    $terms = get_the_terms($id, $taxonomy);
    if (!$terms || is_wp_error($terms)) continue;
?>

<div class="product-sizes">
    <div class="product-sizes__left">
        <p class="product-sizes__label"><?php echo $labels['label']; ?></p>
        <?php if ($labels['info']): ?>
            <span class="product-sizes__info"><?php echo $labels['info']; ?></span>
        <?php endif; ?>
    </div>
    <div class="product-sizes__right">

        <?php
        foreach ($terms as $term):
            $image = get_field('size_image', $term);
        ?>
            <div title="<?php echo $term->name; ?>" class="product-sizes__item">
                <?php echo wp_get_attachment_image($image, 'thumbnail'); ?>
            </div>

        <?php
        endforeach;
        ?>

    </div>
</div>

<?php
endforeach;
?>
