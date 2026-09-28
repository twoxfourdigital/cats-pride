<?php 
/*
* Block Name: Faq
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: ?>

    <section class="faq-wrapper">
        <div class="container">
            <div class="faq_row row">

            <?php if( have_rows('faq') ): ?>
                <div class="accordion">
                    <h2><?php the_field('faq_title'); ?></h2> 
                <?php while( have_rows('faq') ): the_row(); 
                    $image = get_sub_field('image');
                    ?>
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="accordion-icon"><i class="fa-solid fa-chevron-down"></i></span>
                            <span class="accordion-title"><?php the_sub_field('faq_question'); ?></span>
                        </button>
                        <div class="accordion-content">
                            <p><?php the_sub_field('faq_answer')?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
                
                    
                
            </div>
        </div>
    
    </section><!-- .faq-wrapper-->
    
<?php endif; ?>