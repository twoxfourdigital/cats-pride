<?php
/*
* Block Name: Video Section
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $title = get_field('title');
    $button = get_field('button');
    $video = get_field('video', false, false);
    $videoImagePlaceholder = get_field('video_image_placeholder');

?>

    <section class="video-section">
        <div class="container">
            <div class="video-section__items row">
                <div class="video-section__left <?php if ($title) : ?>col-lg-4<?php endif; ?>">

                    <?php if ($title): ?>

                        <h2 class="title-secondary"><?php echo $title; ?></h2>

                    <?php endif; ?>

                    <?php if ($button): ?>

                        <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--green" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                    <?php endif; ?>

                </div>
                <div class="video-section__right <?php if (!$title) : ?>col-lg-6 <?php else : ?>col-lg-8 <?php endif; ?>">

                    <?php if ($videoImagePlaceholder && $video): ?>

                        <a class="video-section__image" data-fancybox href="<?php echo $video; ?>" aria-label="<?php echo $title; ?>">
                            <?php echo wp_get_attachment_image($videoImagePlaceholder, 'large'); ?>
                            <!-- <img loading="lazy" decoding="async" width="360" height="360" src="https://catspride.com/wp-content/uploads/2023/08/video-thumbnail.png"> -->
                        </a>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section><!-- .video-section-->

<?php endif; ?>