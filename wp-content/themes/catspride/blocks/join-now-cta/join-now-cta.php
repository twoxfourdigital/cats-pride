<?php 
/*
* Block Name: Join Now Cta
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

$content = get_field('cta_content');
$cta_button =  get_field('cta_link');
$cta_desc = get_field('cta_link_description');

?>

    <section class="join-now-cta-wrapper">
        <div class="container">
            <div class="join-now-cta_row row">
                <div class="col-lg-8">
                    <?php echo $content; ?>
                </div>
                <div class="col-lg-4 cta-button-wrapper">
                    <div><a <?php if ($cta_button['target']) echo 'target=' . $cta_button['target']; ?> class="primary-button--white" href="<?php echo $cta_button['url']; ?>"><?php echo $cta_button['title']; ?></a></div>
                    <div class="cta-desc">
                        <?php echo $cta_desc; ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- .join-now-cta-wrapper-->
    
<?php endif; ?>