<?php 
/*
* Block Name: Column Block
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: ?>

    <section class="column-block-wrapper">
        <div class="container">
        <div class="column-main-content">
            <?php echo get_field('section_content');?>
        </div>
        <?php if (have_rows('columns')): ?>
            <div class="column-block_row row">
            <?php while (have_rows('columns')) : the_row(); 
            $column_title = get_sub_field('column_title');
            $column_content = get_sub_field('column');
            $column_icon = get_sub_field('column_icon');
             ?>
                <div class="column-wrapper col-md-4">
                    <?php if($column_icon !='') { ?>
                        <div class="column-icon">
                                <?php  echo wp_get_attachment_image($column_icon, 'full'); ?>
                        </div>
                    <?php } ?>
                    <div class="column-content">
                        <?php echo $column_content; ?>
                    </div>
                </div>
                
                <?php endwhile; ?>

            </div>
            <?php endif; ?>
			


													
                                                   
                                                
											
        </div>
    </section><!-- .column-block-wrapper-->
    
<?php endif; ?>