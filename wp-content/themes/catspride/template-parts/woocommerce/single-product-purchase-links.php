<?php
$links = get_field('purchase_links', get_the_ID());
$link_text = get_field('product_button_text');
if (!$links)
    return;
?>

<div class="purchase-links">
    <p class="purchase-links__highlight">
        <?php if ($link_text) {
            echo $link_text;
        } else {
            esc_html_e('Buy Online -or- Find a Store', 'cats-pride');
        } ?>
    </p>
    <div class="purchase-links__items">
        <?php foreach ($links as $link): ?>

            <a target="_blank" href="<?php echo $link['url']; ?>" class="purchase-links__item">
                <img alt="<?php echo $link['name']['value']; ?>"
                    src="<?php echo get_template_directory_uri() . '/assets/images/' . $link['name']['value'] . '.svg'; ?>" />
            </a>

        <?php endforeach; ?>
        </a>
    </div>
</div>