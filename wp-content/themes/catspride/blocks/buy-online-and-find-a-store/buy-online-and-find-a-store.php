<?php 
/*
* Block Name: Buy Online And Find A Store
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

$buy_online_title = get_field('buy_online_title');
$find_store_title = get_field('find_a_store_title');
$find_store_shortcode = get_field('find_a_store_shortcode');
?>

    <section class="buy-online-and-find-a-store-wrapper">
        <div class="container">
            <div class="buy-online-and-find-a-store_row row">
                <div class="col-lg-8">
                    <h2><?php echo $buy_online_title;?></h2>
                    <div class="shop-list">
                        <?php if (have_rows('shop_external', 'option')):
                                while (have_rows('shop_external', 'option')) : the_row();

                                    $shop_link = get_sub_field('shop_link');
                                    $shop_icon = get_sub_field('shop_icon'); ?>

                                    <a href="<?php echo $shop_link; ?>"><img src="<?php echo $shop_icon['url']; ?>" alt="<?php echo $shop_icon['title']; ?>"></a>

								<?php endwhile;
							endif; ?>           
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shortcode-wrapper">
                        <?php echo do_shortcode($find_store_shortcode);?>
                    </div>       
                </div>
            </div>
        </div>
    </section><!-- .buy-online-and-find-a-store-wrapper-->
    
<?php endif; ?>