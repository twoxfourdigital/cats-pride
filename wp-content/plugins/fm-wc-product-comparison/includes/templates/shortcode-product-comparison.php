<?php

$comparison_features = [
  'Max Power' => ['attribute' => 'Max Power'],
  'Lightweight' => ['attribute' => 'Lightweight'],
  'Best Odor Control' => ['attribute' => 'Best Odor Control'],
  'Antibacterial' => ['attribute' => 'Antibacterial'],
  'Hypoallergenic / Unscented' => ['attribute' => 'Hypoallergenic / Unscented'],
  'Natural' => ['attribute' => 'Natural'],
  'Strongest Clumping' => ['attribute' => 'Strongest Clumps'],
  '99% Dust Free' => ['attribute' => '99% Dust Free'],
  'Powered with Baking Soda' => ['attribute' => 'Powered with Baking Soda'],
  'Safe to Flush*' => ['attribute' => 'Flushable'],
  'Good for Multiple Cats' => ['attribute' => 'Good for Multiple Cats'],
  'Litter for Good Shelter Donation' => ['attribute' => 'Litter for Good Shelter Donation', 'category_id' => 62 ],
];

$args = [ 'status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'limit' => $atts['limit'] ];

if (isset( $atts['include'] ) && !empty( $atts['include'] )) {
  $args['include'] = explode( ',', $atts['include'] );
}

if (isset( $atts['orderby'] ) && !empty( $atts['orderby'] )) {
  $args['orderby'] = ($atts['orderby'] ==='manual') ? 'post__in' : 'menu_order';
}

$products = wc_get_products( $args );

$max_purchase_links_count = 0;
foreach ( $products as $product ) {
  $product_id = $product->get_id();
  $count = 0;
  $purchase_links = get_field('purchase_links', $product_id);
  if (is_array($purchase_links)) {
    //var_dump($purchase_links);
    $count = count($purchase_links);
    $max_purchase_links_count = max($max_purchase_links_count, $count);
  }

}
$purchase_link__height = ($max_purchase_links_count + 1) * 52 + 40;
//var_dump($max_purchase_links_count, $purchase_link__height);

// Code for finding empty features
$not_empty_features = [];
if ( isset( $atts['type'] ) && $atts['type'] === 'full' ) {
  foreach ($products as $product) {
    $product_features = explode( ', ', $product->get_attribute( 'features' ) );
    $categories  = $product->get_category_ids();
    foreach ($comparison_features as $comparison_feature_title => $comparison_feature_data ) {
      // var_dump($comparison_feature_data['attribute']);
      // var_dump(in_array( $comparison_feature_data['attribute'], $product_features ));
      // echo '<br><br>';
      if (!isset($not_empty_features[$comparison_feature_data['attribute']]) && (
          in_array( $comparison_feature_data['attribute'], $product_features ) ||
          (isset($comparison_feature_data['category_id']) &&
          in_array( $comparison_feature_data['category_id'], $categories ))
        )
      ) {
        $not_empty_features[$comparison_feature_data['attribute']] = true;
      }
    }
  }
}
?>
<section class="cd-products-comparison-table">
  <?php /*
  <header>
      <div class="actions">
          <a href="#0" class="reset">Reset</a>
          <a href="#0" class="filter">Filter</a>
      </div>
  </header>
  */ ?>
  <div class="cd-products-table">
    <div class="features">
      <div class="top-info">
        <!-- <?php if ( isset( $atts['type'] ) && $atts['type'] === 'full' ) { ?>Benefits<?php } ?> -->
      </div>
      <div class="cd-product-name">
        <!-- <?php if ( isset( $atts['type'] ) && $atts['type'] === 'full' ) { ?>Benefits<?php } ?> -->
      </div>
      <ul class="cd-features-list">
        <?php if ( isset( $atts['type'] ) && $atts['type'] === 'retailer' ) { ?>
          <li style="height: <?php echo $purchase_link__height ?>px;">Retailer/Store Availability</li>
        <?php } ?>
        <?php if ( isset( $atts['type'] ) && $atts['type'] === 'full' ) { ?>
            <?php foreach ( $comparison_features as $title => $feature ) { ?>
                <?php if (isset($not_empty_features[$feature['attribute']])) { ?>
                <li><?php echo $title; ?></li>
              <?php } ?>
            <?php } ?>
        <?php } ?>
      </ul>
    </div> <!-- .features -->
      <div class="cd-products-wrapper">
        <ul class="cd-products-columns" style="width: <?php echo count( $products ) * 146; ?>px !important;">
          <?php
          /**
           * @var $product WC_Product
           */
          foreach ( $products as $product ) {

            $features    = explode( ', ', $product->get_attribute( 'features' ) );
            $categories  = $product->get_category_ids();
            $description = get_field( 'comparison_chart_description', $product->get_id() );
            $item_id     = get_field( 'store_locator_product_id', $product->get_id() );

            if ( count($features) === 0 ) {
              $features = array();
            }
            ?>
            <li class="cd-product">
              <div class="top-info">
                <?php /* <div class="check"></div> */ ?>
                <a href="<?php echo get_permalink( $product->get_id() ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
                  <?php echo $product->get_image(); ?>
                </a>
              </div> <!-- .top-info -->
              <div class="cd-product-name">
                <?php /* <div class="check"></div> */ ?>
                <a href="<?php echo get_permalink( $product->get_id() ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
                  <h3><?php echo $product->get_title(); ?></h3>
                </a>
              </div>
              <?php
              /*
              <div class="top-info">
                <p><?php echo (!empty( $description ) ? $description : $product->get_short_description() ); ?></p>
              </div>
              */
              ?>
              <ul class="cd-features-list">
                <?php if ( isset( $atts['type'] ) && $atts['type'] === 'retailer' ) { ?>
                  <li style="height: <?php echo $purchase_link__height ?>px;">
                    <?php echo do_shortcode('[cp_buy_online product_id="' . $product->get_id() . '" show_title="false" button_class="blue"]'); ?>
                    <div class="x-column x-sm x-1-3">
                      <a href="/store-locator/<?php echo ( $item_id ) ? '?item_id=' . $item_id : ''; ?>" class="x-btn blue-rev x-btn-global store-locator">Find a Store</a>
                    </div>
                  </li>
                <?php } ?>
                <?php if ( isset( $atts['type'] ) && $atts['type'] === 'full' ) { ?>
                  <?php foreach ( $comparison_features as $featureTitle => $feature ) { ?>
                    <?php if (isset($not_empty_features[$feature['attribute']])) { ?>
                      <li><?php echo ( in_array( $feature['attribute'], $features ) || (isset($feature['category_id']) && in_array( $feature['category_id'], $categories )) ) ? '<span class="product-has-feature icon-checkmark"></span>' : '<span></span>'; ?></li>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </ul>
            </li> <!-- .product -->
        <?php } ?>
      </ul> <!-- .cd-products-columns -->
    </div> <!-- .cd-products-wrapper -->
  </div> <!-- .cd-products-table -->
  <?php if ( isset( $atts['navigation'] ) && $atts['navigation'] === 'yes' ) { ?>
    <ul class="cd-table-navigation">
      <li><a href="#0" class="prev inactive icon-left-arrow"></a></li>
      <li><a href="#0" class="next icon-right-arrow"></a></li>
    </ul>
  <?php } ?>
</section> <!-- .cd-products-comparison-table -->
