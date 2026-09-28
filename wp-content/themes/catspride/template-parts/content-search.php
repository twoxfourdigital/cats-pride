<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CatsPride
 */

?>

<?php
$blogImage = get_the_post_thumbnail(get_the_ID(), 'medium');
$title = get_the_title();
$blog_content = wp_trim_words(get_the_content(), 15);

?>
<div class="search__item col-lg-3 col-sm-6">
    <a href="<?php the_permalink(); ?>">
        <?php if ($blogImage): ?>

            <div class="search__item-image">
                <?php echo $blogImage; ?>
            </div>

        <?php endif; ?>

        <?php if ($title): ?>

            <h3 class="title-third"><?php echo $title; ?></h3>

        <?php endif; ?>

        <div class="search__item-details">
            <p class="search__item-date"><i class="fa-solid fa-clock"></i> <?php echo get_the_date('F d, Y'); ?></p>
            <p class="search__item_excerpt">
                <?php echo $blog_content; ?>
            </p>
        </div>
    </a>
</div>

