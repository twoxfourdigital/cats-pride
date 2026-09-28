<?php
/*
 * Block Name: Go Big Go Home
 * Post Type: page
 */

if (isset($block['data']['preview_image_help'])):
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $content_logo = get_field('content_logo');
    $content = get_field('content');
    $content_cta = get_field('call_to_action');
    $big_image = get_field('big_image');
    ?>
<style>
    @media (max-width: 991px) {
                .go-big-go-home-wrapper .go-big-go-home__inner {
                    
                    padding: 70px 20px !important;
                    padding-bottom: 0 !important;
                }
                .go-big-go-home__cat-image {
                    margin-bottom: 0 !important;
                }
            }
    </style>
    <section class="go-big-go-home-wrapper">
        <div class="container px-0">
            <div class="go-big-go-home__inner">

                <div class="go-big-go-home__content">
                    <div class="go-big-go-home__logo-wrap">
                        <?php if ($content_logo) { ?>
                            <img src="<?php echo $content_logo['url']; ?>" alt="<?php echo $content_logo['alt']; ?>"
                                onerror="this.style.display='none'">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/go-big-go-home-logo.png"
                                alt="Go Big Go Home Logo" onerror="this.style.display='none'">
                        <?php } ?>
                    </div>
                    <?php if ($content) {
                        echo $content;
                    } else { ?>
                        <h2><strong>BUYING CAT'S PRIDE</strong><br>IS A BIG DEAL</h2>
                        <p>Cat's Pride is proud to make an even bigger difference for animals in need.</p>
                        <p>Pick up any Cat's Pride cat litter and help support our goal to donate 1,000,000 lbs of litter to
                            shelters.</p>
                    <?php } ?>
                    <?php if ($content_cta) { ?>
                        <a href="<?php echo $content_cta['url']; ?>"
                            class="go-big-go-home__btn"><?php echo $content_cta['title']; ?></a>
                    <?php } else { ?>
                        <a href="#" class="go-big-go-home__btn">Shop Now</a>
                    <?php } ?>
                </div>

                <div class="go-big-go-home__cat-image">
                    <?php if ($big_image) { ?>
                        <img src="<?php echo $big_image['url']; ?>" alt="<?php echo $big_image['alt']; ?>"
                            onerror="this.style.display='none'">
                    <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/go-big-go-home-cat.png"
                            alt="Big Cat smiling for Go Big Go Home campaign" onerror="this.style.display='none'">
                    <?php } ?>
                </div>



            </div>
        </div>
    </section><!-- .go-big-go-home-wrapper -->

<?php endif; ?>