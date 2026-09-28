<?php
/*
* Block Name: Shop Online
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    $title = get_field('title');
?>

    <section class="shop-online">
        <div class="shop-online__inner">
            <div class="container">
                <?php if ($title) : ?>
                    <h3 class="title-third"><?php echo $title; ?></h4>
                <?php endif; ?>
                <ul class="shop-list-wrapper">
                    <?php if (have_rows('shop_external', 'option')):
                        while (have_rows('shop_external', 'option')) : the_row();
    
                            $shop_link = get_sub_field('shop_link');
                            $shop_icon = get_sub_field('shop_icon'); ?>
    
                            <li><a href="<?php echo $shop_link; ?>"><img src="<?php echo $shop_icon['url']; ?>" alt="<?php echo $shop_icon['title']; ?>"></a></li>
    
                    <?php endwhile;
                    endif; ?>
    
                </ul>
            </div>
        </div>
    </section>

<?php endif; ?>