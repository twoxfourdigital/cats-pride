<?php
$style = $args['style'];
$bannerNo = $style === 'blue' ? '1' : '2'; 
$banner = get_field('banner_'.$bannerNo, 'options');
$title = $banner['banner_'.$bannerNo.'_title'];
$description = $banner['banner_'.$bannerNo.'_description'];
$button = $banner['banner_'.$bannerNo.'_button'];
?>

<section class="banner <?php echo $style; ?> col-md-6">
    <div class="banner__inner">

        <?php if ($title): ?>

            <h3 class="title-third"><?php echo $title; ?></h3>

        <?php endif; ?>

        <?php if ($description): ?>

            <div class="banner__description">
                <?php echo $description; ?>
            </div>

        <?php endif; ?>

        <?php if ($button): ?>

            <div class="banner__button-wrapper">
                <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--white banner__button" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                <?php if($style === 'blue'): ?>

                    <img width="60px" height="53px" src="<?php echo get_template_directory_uri() . '/assets/images/banner-button-image.png' ?>" alt="Banner Image" />

                <?php endif; ?>
            </div>

        <?php endif; ?>

    </div>
</section>