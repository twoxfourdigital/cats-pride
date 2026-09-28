<?php
/*
 * Block Name: Humane Society
 * Post Type: page
 */

if (isset($block['data']['preview_image_help'])):
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $top_bar = get_field('top_bar');
    $section_image = get_field('section_image');
    $section_content = get_field('section_content');
    $cta = get_field('cta');

    ?>

    <section class="humane-society-wrapper">

        <?php if ($top_bar) { ?>
            <div class="humane-society__topbar">
                <p>
                    <?php echo $top_bar; ?>
                </p>
            </div>
        <?php } ?>

        <div class="humane-society__main">
            <div class="container">
                <div class="humane-society__row row align-items-center">

                    <div class="humane-society__image col-lg-5">
                        <?php if ($section_image) { ?>
                            <img src="<?php echo $section_image['url']; ?>" alt="<?php echo $section_image['alt']; ?>"
                                onerror="this.style.display='none'">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/humane-society-cat.png"
                                alt="Cat resting - American Humane Society" onerror="this.style.display='none'">
                        <?php } ?>
                    </div>

                    <div class="humane-society__content col-lg-7">
                        <?php if ($section_content) { ?>
                            <?php echo $section_content; ?>
                        <?php } else { ?>
                            <h2>Giving Animals a<br>Second Chance with<br><span>American Humane Society</span></h2>
                            <p>Cat's Pride is proud to partner with American Humane Society to help animals in need. Through our
                                Go Big Go Home program, your purchase helps support litter donations to shelters nationwide.
                                Want to do even more? Support American Humane Society Second Chance Grants to provide
                                life-saving care and help more animals find loving homes.</p>
                        <?php } ?>
                        <div class="humane-society__actions">
                            <?php if ($cta) { ?>
                                <a href="<?php echo $cta['url']; ?>"
                                    class="primary-button--green"><?php echo $cta['title']; ?></a>
                            <?php } ?>
                            <img class="humane-society__logo"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/american-humane-logo.png"
                                alt="American Humane Society Logo" onerror="this.style.display='none'">
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section><!-- .humane-society-wrapper -->

<?php endif; ?>

