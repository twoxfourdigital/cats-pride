<?php
$image = get_field('product_archive_image', 'options');
$background = get_field('product_archive_background', 'options');
$title = get_field('product_archive_title', 'options');
$description = get_field('product_archive_description', 'options');
$video_url = get_field('product_archive_video', 'options');
$video_header_text = get_field('product_arhive_video_header_text', 'options');
$sub_title = get_field('product_arhive_video_header_sub_title', 'options');
$hero_link = get_field('product_archive_link', 'options');
?>

<?php if ($video_url): ?>
      <section class="hero-video-wrapper">
        <div class="container">
            <div class="hero-video_row row">
                <div class="col-lg-7">
                     <?php echo $video_url;?>   
                </div>
                <div class="col-lg-4">
                        <?php if ($video_header_text): ?>
                            <h2><?php echo $video_header_text; ?></h2>
                        <?php endif; ?>
                           <?php if ($sub_title): ?>
                           <p class="hero-subtitle"><?php echo $sub_title; ?></p>
                        <?php endif; ?>
                </div>
            </div>
            
        </div>
    </section>

<?php else: ?>
<?php if ($hero_link): ?> <a href="<?php echo $hero_link;?>"> <?php endif;?>
<section class="archive-product-hero" <?php if ($background) echo 'style=background-image:url(' . wp_get_attachment_url($background) . ');'; ?>>
    <div class="container">
        <div class="archive-product-hero__inner row">
           
                <div class="archive-product-hero__left col-lg-6">

                    <?php if ($image): ?>

                        <div class="archive-product-hero__image">
                            <?php echo wp_get_attachment_image($image, 'large'); ?>
                        </div>

                    <?php endif; ?>

                </div>
                <div class="archive-product-hero__right col-lg-6">

                    <?php if ($title): ?>

                        <h1 class="title-primary"><?php echo $title; ?></h1>

                    <?php endif; ?>

                    <?php if ($description): ?>

                        <div class="archive-product-hero__description">
                            <?php echo $description; ?>
                        </div>

                    <?php endif; ?>

                </div>
           
        </div>
    </div>
</section>
 <?php if ($hero_link): ?></a><?php endif;?>
<?php endif; ?>