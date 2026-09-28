<?php

/**
 * Template part for displaying single posts.
 *
 * @package CatsPride
 */
$post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header>

	<span class="single-blog-cats">
		<?php
		$cat_sum = count($post_categories);
		$i = 0;
		foreach ($post_categories as $post_cat) {
			$i++;
			if ($i === $cat_sum) echo $post_cat;
			else echo $post_cat . ", ";
		} ?>
	</span>
	<span class="single-blog-date"><i class="fa-solid fa-clock"></i> <?php echo get_the_date('F d, Y'); ?></span>


	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>