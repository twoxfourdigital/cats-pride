<?php
/*
* Block Name: Blog
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else:

    global $post;
    
    $title = get_field('title');
    $description = get_field('description');
    $posts = get_field('posts');
    $blogsPosts = $posts ? $posts : get_posts([
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);
?>

    <section class="blog">
        <div class="container">
            <div class="blog__inner">

                <?php if ($title): ?>

                    <h2 class="title-secondary"><?php echo $title; ?></h2>

                <?php endif; ?>

                <?php if ($description): ?>

                    <div class="blog__description">
                        <?php echo $description; ?>
                    </div>

                <?php endif; ?>

                <?php if ($blogsPosts): ?>

                    <div class="blog__items row">

                        <?php
                        foreach ($blogsPosts as $blogPost):
                            $post = $blogPost;
                            setup_postdata($post);
                            get_template_part('template-parts/content', 'blog');
                        endforeach;
                        wp_reset_postdata();

                        ?>
                    </div>

                <?php endif; ?>

                <div class="blog-button">
                    <a class="primary-button--purple" href="<?php echo get_post_type_archive_link('post'); ?>"><?php esc_html_e('View Blog', 'cats-pride'); ?></a>
                </div>


            </div>
        </div>
    </section><!-- .blog-->

<?php endif; ?>