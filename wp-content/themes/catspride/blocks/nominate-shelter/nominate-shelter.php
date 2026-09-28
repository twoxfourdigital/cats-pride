<?php
/*
 * Block Name: Nominate Shelter
 * Post Type: page
 */

if (isset($block['data']['preview_image_help'])):
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:
    $section_content = get_field('section_content');

    $section_cta = get_field('cta');

    $section_image = get_field('section_image');

    $section_video = get_field('section_video');

    $section_image_video = get_field('image_or_video');
    ?>
<style> 
.nominate-shelter__image-wrap iframe {
    max-height: 450px;
}


</style>
    <section class="nominate-shelter-wrapper">
        <div class="container">
            <div class="nominate-shelter__row row align-items-center">

                <div class="nominate-shelter__content col-lg-6">
                    <?php if ($section_content) { ?>
                        <?php echo $section_content; ?>
                    <?php } else { ?>
                        <h2>Our litter makes<br><strong>a big difference.</strong></h2>
                        <p>Nominate your shelter to receive litter donations. The more nominations a shelter receives, the more
                            litter that is donated to that shelter. Cat's Pride will donate litter to help shelters free up
                            their resources to focus on helping more animals find their forever homes.</p>

                    <?php } ?>
                    <?php if ($section_cta) { ?>
                        <a href="<?php echo $section_cta['url']; ?>"
                            class="primary-button--green"><?php echo $section_cta['title']; ?></a>
                    <?php } ?>
                </div>

                <div class="nominate-shelter__image col-lg-6">
                    <div class="nominate-shelter__image-wrap">
                        
                        <?php if($section_image_video){ ?>
                            <?php if ($section_image) { ?>
                                <img src="<?php echo $section_image['url']; ?>" alt="<?php echo $section_image['alt']; ?>"
                                    onerror="this.style.display='none'">
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nominate-shelter-cat.jpg"
                                    alt="Woman holding a cat" onerror="this.style.display='none'">
                            <?php } 
                            } else {
                            echo $section_video;        
                        }?>
                            
                        
                    </div>
                </div>

            </div>
        </div>
    </section><!-- .nominate-shelter-wrapper -->

<?php endif; ?>