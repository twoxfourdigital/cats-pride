<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
$externalID = get_field('bazaarvoice_product_id', get_the_ID(), false);


/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
	<div class="container clear-fix">

		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action('woocommerce_before_single_product_summary');
		?>

		<div class="summary entry-summary">


			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */


			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


			add_action('woocommerce_single_product_summary', function () use ($externalID) {
				get_template_part('template-parts/woocommerce/single-product', 'review-summary', [
					'externalID'        => $externalID,
				]);
			}, 21);

			add_action('woocommerce_single_product_summary', function () {
			?>

				<div class="product__content">
					<?php the_content(); ?>
				</div>

			<?php
			}, 22);

			add_action('woocommerce_single_product_summary', function () {
				get_template_part('template-parts/woocommerce/single-product', 'sizes');
			}, 23);

			add_action('woocommerce_single_product_summary', function () {
				get_template_part('template-parts/woocommerce/single-product', 'purchase-links');
				get_template_part('template-parts/woocommerce/find-store');
				// get_template_part('template-parts/woocommerce/product', 'search-form');
				echo do_shortcode('[cp_find_a_store show_title="false"]');
			}, 24);
			do_action('woocommerce_single_product_summary');


			?>
		</div>
	</div>

	<?php get_template_part('template-parts/woocommerce/single-product', 'highlights', [
		'style' => 'highlights_dfu'
	]); ?>
	<?php get_template_part('template-parts/woocommerce/single-product', 'highlights', [
		'style' => 'highlights'
	]); ?>		
<?php get_template_part('template-parts/woocommerce/single-product', 'health'); ?>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 30);
	do_action('woocommerce_after_single_product_summary');
	?>



</div>

<?php do_action('woocommerce_after_single_product'); ?>

<section class="banners">
<div class="container">
		<div class="row">
			<?php get_template_part('template-parts/banner', null, ['style' => 'blue']); ?>
			<?php get_template_part('template-parts/banner', null, ['style' => 'green']); ?>
		</div>
	</div>
</section>