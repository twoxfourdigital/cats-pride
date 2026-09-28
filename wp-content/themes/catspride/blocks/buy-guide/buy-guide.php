<?php
/*
* Block Name: Buy Guide
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:
    $image = get_field('image');
    $title = get_field('title');
    $subtitle = get_field('subtitle');
    $button1 = get_field('button_1');
    $button2 = get_field('button_2');
    $icons = get_field('icons');

?>

    <section class="buy-guide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/buy-guide-background.jpg')">
        <div class="container">
            <div class="buy-guide__inner">
                <div class="buy-guide__items row">
                    <div class="buy-guide__left col-lg-6">

                        <?php if ($image): ?>

                            <div class="buy-guide__image">
                                <?php echo wp_get_attachment_image($image, 'medium'); ?>
                            </div>

                        <?php endif; ?>
                    </div>
                    <div class="buy-guide__right col-lg-6">

                        <?php if ($title): ?>

                            <h2 class="title-secondary"><?php echo $title; ?></h2>

                        <?php endif; ?>

                        <?php if ($subtitle): ?>

                            <p class="buy-guide__subtitle"><?php echo $subtitle; ?></p>

                        <?php endif; ?>

                        <?php if ($button1 || $button2): ?>

                            <div class="buy-guide__buttons">

                                <?php if ($button1): ?>

                                    <a <?php if ($button1['target']) echo 'target=' . $button1['target']; ?> class="primary-button--light-blue buy-guide-button" href="<?php echo $button1['url']; ?>"><?php echo $button1['title']; ?></a>

                                <?php endif; ?>

                                <?php if ($button2): ?>

                                    <a <?php if ($button2['target']) echo 'target=' . $button2['target']; ?> class="primary-button--light-blue" href="<?php echo $button2['url']; ?>"><?php echo $button2['title']; ?></a>

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                        <?php if ($icons): ?>

                            <div class="buy-guide__icons">

                                <span><strong>Buy</strong> Online</span>

                                <?php foreach ($icons as $icon): ?>
                                       
                                    <div class="buy-guide__icon">

                                        <?php if ($icon['url']): ?>

                                            <a class="buy-guide__icon-wrapper" target="_blank" href="<?php echo $icon['url']; ?>" aria-label="Buy Guide External Link">
                                                <?php if ($icon['icon']): ?>
                                                <div class="buy-guide__icon-wrapper">
                                                    <?php echo wp_get_attachment_image($icon['icon'], 'medium'); ?>
                                                </div>
                                                <?php else: ?>
                                                    <img decoding="async" width="300" height="300" src="<?php echo get_template_directory_uri(); ?>/assets/images/amazon_cats-pride-icons.svg" sizes="(max-width: 300px) 100vw, 300px" alt='amazon'>
                                                <?php endif; ?>
                                            </a>
                                        <?php endif; ?>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- .buy-guide-->

<?php endif; ?>