<?php
$query_args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);
$loop = new WP_Query($query_args);
$products = wp_list_pluck($loop->posts, 'ID');
wp_reset_query();
$products_str = implode(",", $products);
?>

<section class="product-compare">
    <div class="container">
        <div class="product-compare__inner">
            <h2><?php esc_html_e('Compare Cat’s Pride’s Unique Formulas', 'cats-pride') ?> </h2>
            <?php
            if (!empty($products_str)) {
                echo do_shortcode("[fm_wc_product_comparison include=\"$products_str\"]");
            } else {
                echo "<p>No products were found matching your selection.</p>";
            }
            ?>
        </div>
    </div>
</section>
