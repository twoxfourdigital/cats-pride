<?php
$blogImage = get_the_post_thumbnail(get_the_ID(), 'medium');
$title = get_the_title();
$post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));
$blog_content = wp_trim_words(get_the_content(), 15);

?>
<div class="blog__item col-lg-3 col-sm-6">
    <a href="<?php the_permalink(); ?>">
        <?php if ($blogImage): ?>

            <div class="blog__item-image">
                <?php echo $blogImage; ?>
            </div>

        <?php endif; ?>

        <?php if ($title): ?>

            <h3 class="title-third"><?php echo $title; ?></h3>

        <?php endif; ?>

        <div class="blog__item-details">
            <p class="blog__item-cats">
                <?php
                $cat_sum = count($post_categories);
                $i = 0;
                foreach ($post_categories as $post_cat) {
                    $i++;
                    if ($i === $cat_sum) echo $post_cat;
                    else echo $post_cat . ", ";
                } ?>
            </p>
            <p class="blog__item-date"><i class="fa-solid fa-clock"></i> <?php echo get_the_date('F d, Y'); ?></p>
            <p class="blog__item_excerpt">
                <?php echo $blog_content; ?>
            </p>
        </div>
    </a>
</div>