<?php 
/*
* Block Name: Landing Hero
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

    $hero_image = get_field('hero_image');
    $hero_content = get_field('hero_content');


?>

    <section class="landing-hero-wrapper" style="background-image:url(<?php echo wp_get_attachment_image_url($hero_image, 'full'); ?>)">
        <div class="landing-hero-container container">
            <div class="landing-hero-row">
                    <?php echo $hero_content; ?>
            </div>
        </div>
    </section><!-- .landing-hero-wrapper-->
    
<?php endif; ?>