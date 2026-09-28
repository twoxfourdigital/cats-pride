<?php
/**
* Template Name: Landing Page
 *
 * @package CatsPride
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

		<?php endwhile; // End of the loop. ?>
		<div align="center"><script id="propodEmbed8d8c57b3b0e44c6c91c7a0bbb749688a" src="https://banner2.promotionpod.com/frames/8d8c57b3b0e44c6c91c7a0bbb749688a.js"></script></div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
