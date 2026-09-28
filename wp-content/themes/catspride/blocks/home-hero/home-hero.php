<?php
/*
* Block Name: Home Hero
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $title = get_field('title');
    $upperTitle = get_field('upper_title');
    $image = get_field('image');
    $background = get_field('background');
    $button = get_field('button');
?>

    <section class="home-hero" <?php if ($background) echo 'style=background-image:url(' . wp_get_attachment_url($background) . ');'; ?>>
        <div class="container">
            <div class="home-hero__inner">
                <div class="home-hero__items row">
                    <div class="home-hero__left col-lg-6">

                        <?php if ($image): ?>

                            <div class="home-hero__image">
                                <?php echo wp_get_attachment_image($image, 'full');  ?>
                            </div>

                        <?php endif; ?>

                    </div>
                    <div class="home-hero__right col-lg-6">

                        <?php if ($upperTitle): ?>

                            <h3 class="title-third"><?php echo $upperTitle; ?></h3>

                        <?php endif; ?>

                        <?php if ($title): ?>

                            <h1 class="title-primary"><?php echo $title; ?></h1>

                        <?php endif; ?>

                        <?php if ($button): ?>

                            <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--white" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- .home-hero-->

<?php endif; ?>