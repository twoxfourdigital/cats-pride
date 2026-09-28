<?php 
/*
* Block Name: Cta
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

$cta_text = get_field('cta_text');
$cta_button_text = get_field('cta_button_text');
$cta_url = get_field('cta_url');
?>

    <section class="cta-wrapper">
        <div class="container">
            <div class="cta_row row">
                <div class="col-lg-9"><h3><span><?php echo $cta_text;?></span></h3></div>
                <div class="col-lg-3"><a href="<?php echo $cta_url; ?>" class='primary-button--purple'><?php echo $cta_button_text; ?></a></div>
            </div>
           
        </div>
    </section><!-- .cta-wrapper-->
    
<?php endif; ?>