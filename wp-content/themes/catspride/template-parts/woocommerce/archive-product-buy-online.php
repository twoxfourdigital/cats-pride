<div class="buy-online-product-archive">
    <h2 class="title-secondary"><?php esc_html_e('Buy Online', 'cats-pride'); ?></h2>

    <?php if (have_rows('shop_external', 'option')): ?>
        <div class="buy-online-product-archive__items">

            <?php while (have_rows('shop_external', 'option')) : the_row();
                $shop_link = get_sub_field('shop_link');
                $shop_icon = get_sub_field('shop_icon'); ?>

                <div class="buy-online-product-archive__item">
                    <a href="<?php echo $shop_link; ?>">
                        <img src="<?php echo $shop_icon['url']; ?>" alt="<?php echo $shop_icon['title']; ?>">
                    </a>
                </div>

            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</div>