<?php 
/*
* Block Name: Donate
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else:
?>

    <section class="donate-wrapper">
        <div class="container">
            <div class="donate_row row">
                <?php echo get_field('donate_content'); ?>
            </div>
        </div>
    </section><!-- .donate-wrapper-->
    
<?php endif; ?>