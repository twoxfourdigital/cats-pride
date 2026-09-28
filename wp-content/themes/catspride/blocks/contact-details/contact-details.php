<?php 
/*
* Block Name: Contact Details
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: ?>

    <section class="contact-details-wrapper">
        <div class="container">
            <div class="contact-details_row">
                <div class="phone">
                    <i class="fa-solid fa-phone"></i> <?php the_field('phone');?>
                </div>

                <div class="email">
                    <i class="fa-solid fa-envelope"></i><?php the_field('email'); ?>
                </div>

                <div class="address"><i class="fa-solid fa-pen-to-square"></i> <?php the_field('address'); ?></div>
            </div>
        </div>

    
    </section><!-- .contact-details-wrapper-->
    
<?php endif; ?>