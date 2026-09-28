<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

$description = $product->get_short_description();
$product_external_ids = get_product_bv_ids();



// Ensure visibility.
if (empty($product) || ! $product->is_visible()) {
	return;
}
?>
<li <?php wc_product_class('', $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item');


	?>

	<div class="product__left">

		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action('woocommerce_before_shop_loop_item_title');

		?>

	</div>


	<div class="product__right">

		<?php

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action('woocommerce_shop_loop_item_title');

		if ($description):
		?>

			<div class="product__description">
				<?php echo $description; ?>
			</div>

		<?php

		endif;

		if ($product->get_id() && isset($product_external_ids[$product->get_id()])) { ?>

			<div class="products-inline-rating">
				<div data-bv-show="inline_rating" data-bv-seo="false" data-bv-product-id="<?php echo $product_external_ids[$product->get_id()]; ?>"></div>
			</div>

		<?php }


		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action('woocommerce_after_shop_loop_item_title');

		?>

	</div>

	<?php


	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	do_action('woocommerce_after_shop_loop_item');
	?>
</li>