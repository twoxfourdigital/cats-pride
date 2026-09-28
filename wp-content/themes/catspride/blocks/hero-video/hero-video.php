<?php 
/*
* Block Name: Hero Video
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] ) ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

$video_embed = get_field('video');
$video_title = get_field('title');
$sub_title = get_field('sub_title');
$video_cta_link = get_field('cta_link');

?>

<section class="hero-video-wrapper">
    <div class="container">
        <div class="hero-video_row row">
            <div class="col-lg-7">
                 <?php echo $video_embed; ?>   
            </div>
            <div class="col-lg-4">
                <h2><?php echo $video_title; ?></h2>
                
                <?php if ($sub_title): ?>
                    <p class="hero-subtitle"><?php echo $sub_title; ?></p>
                <?php endif; ?>
                
                <?php if ($video_cta_link): ?>
                    <a 
                        href="<?php echo $video_cta_link['url']; ?>" 
                        <?php if ($video_cta_link['target']) echo 'target="' . $video_cta_link['target'] . '"'; ?> 
                        class="primary-button--green <?php echo $sub_title ? 'mt-4' : ''; ?>"
                    >
                        <?php echo $video_cta_link['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!-- .hero-video-wrapper-->

<?php endif; ?>