<?php
/*
* Block Name: Banner
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:
    $title = get_field('title');
    $text = get_field('text');
    $button = get_field('button');

    if($text!=''){
?>

    <section class="banner">
        <div class="container">
            <div class="banner__inner">
                <div class="banner__items row">
                    <div class="banner__left col-lg-6">

                        <?php if ($title): ?>

                            <h2 class="banner-title-secondary"><?php echo $title; ?></h2>

                        <?php endif; ?>

                    </div>
                    <div class="banner__right col-lg-6">

                        <?php if ($text): ?>

                            <div class="banner__text">
                                <?php echo $text; ?>
                            </div>

                        <?php endif; ?>

                        <?php if ($button): ?>

                            <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--white" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </section><!-- .banner-->

<?php 
}else { ?>

<section class="banners">
				<div class="container">
					<div class="row">
    <?php  get_template_part('template-parts/banner', null, ['style' => 'blue']);
 get_template_part('template-parts/banner', null, ['style' => 'green']); ?>
</div>
				</div>
			</section>
 <?php 
}
endif; ?>