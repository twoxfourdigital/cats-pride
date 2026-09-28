<?php 
/*
* Block Name: Image Text
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: 

    $image = get_field('block_image');
    $title = get_field('block_title');
    $content = get_field('block_content');
    $orientation = get_field('block_orientation');
    $highlighted = get_field('block_highlighted');
    $layout = get_field('block_layout');
    $button = get_field('cta');
    $video = get_field('video',false,false);


    
    $class1 = 'col-lg-6';
    $class2 = 'col-lg-6';

    if($layout == 'half'){
        $class1 = 'col-lg-6';
        $class2 = 'col-lg-6';
    } else {
        $class1 = 'col-lg-3';
        $class2 = 'col-lg-9';
    }

    $alignment_class = '';
    if (!$image) {
        $alignment_class = 'variable-title';
        $class2 = 'col-12';
    }

  
?>

    <section class="image-text-wrapper">
        <div class="container">
            <?php if($title): ?>
                <div class="image-text_title <?php echo $alignment_class; ?>">
                    <h2><?php echo $title; ?></h2>
                </div>
            <?php endif; ?>
            <div class="image-text_row row <?php echo $alignment_class; ?> <?php if($orientation): echo 'reverse-row'; endif; ?>">
                
                <?php if ($image): ?>
                    <div class="image-text_image <?php echo $class1;?>">
                    <?php if ($video){ ?>
                        <a class="video-section__image" data-fancybox href="<?php echo $video; ?>" aria-label="<?php echo $title; ?>">
                    <?php } ?>        
                        <img src="<?php echo wp_get_attachment_url($image) ?>">
                        <?php if ($video){ ?>
                        </a>
                    <?php } ?>   
                    </div>
                <?php endif; ?>

                <div class="image-text_content <?php echo $class2; if($highlighted): echo ' highlighted'; endif; ?>">
                    <?php echo $content; ?>

                    <?php if ($button): ?>

                        <a <?php if ($button['target']) echo 'target=' . $button['target']; ?> class="primary-button--green" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>

                        <?php endif; ?>

                </div>
            </div>
        </div>
    </section><!-- .image-text-wrapper-->
    
<?php endif; ?>