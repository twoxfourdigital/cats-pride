<?php 
/*
* Block Name: Quote Section
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

$image = get_field('quote_image');
?>

    <section class="quote-section-wrapper" style="background-image:url('<?php echo wp_get_attachment_url($image) ?>')">
        <div class="container">
            <div class="quote-section_row row">
                <div class="quote-section_content">
                    <?php echo get_field('content');?>
                </div>
            </div>
        </div>
    </section><!-- .quote-section-wrapper-->
    
<?php endif; ?>