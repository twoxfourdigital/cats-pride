<?php 
/*
* Block Name: Classic Editor
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: ?>

    <section class="classic-editor-wrapper">
        <div class="container">
            <div class="content-wrapper">
                <?php the_field('content')?>
            </div>
        </div>
    </section><!-- .classic-editor-wrapper-->
    
<?php endif; ?>