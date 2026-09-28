<?php 
/*
* Block Name: Product Highlight
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else:

$main_title= get_field('title');
$background_color = get_field('section_background');
$product_image = get_field('product_image');
$product_content = get_field('product_description');
$button = get_field('product_cta');
$product_note = get_field('product_notice');





?>

    <section class="product-highlight-wrapper" >

    <?php if($main_title !=''){ ?>
        <div class="main-title-wrapper">
            <div class="container">
                <h1><?php echo $main_title; ?></h1>
            </div>
        </div>

    <?php } ?>  

    <div class="product-hihglight-inner-wrapper" style="background-image:url('<?php echo wp_get_attachment_image_url($background_color, 'full'); ?>')">
        <div class="product-container container">
            <div class="product-image-wrapper">
                <?php echo wp_get_attachment_image($product_image, 'full'); ?>
                
            </div>
            <div class="product-desc-wrapper">
                <?php echo $product_content;?>
                <?php if ($button): ?>

                    <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--green" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                    <?php endif; ?>

                    <p class="product-notice"><?php echo $product_note; ?></p>
            </div>
            <?php if (have_rows('product_benefits')): ?>
                <div class="benefit-main-wrapper">
                <?php while (have_rows('product_benefits')) : the_row(); 
                    $benefit_title = get_sub_field('benefit_title');
                    $benefit_content = get_sub_field('benefit_description');
                    $icon = get_sub_field('icon');
                    ?>
                    <div class="sinlge-benefit-wrapper">
                        <div class="benefit-icon-wrapper">
                        <?php echo wp_get_attachment_image($icon, 'full'); ?>
                        </div>
                        <div class="benefit-content-wrapper">
                            <h4><?php echo $benefit_title; ?></h4>
                            <p><?php echo $benefit_content;?></p>
                        </div>
                    </div>
                    


                <?php endwhile;?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    </section><!-- .product-highlight-wrapper-->
    
<?php endif; ?>