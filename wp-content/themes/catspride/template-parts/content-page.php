<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package CatsPride
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>

		<?php if (is_page("store-locator") || is_page("ultra-clean-cat-litter") || is_page("ultra-clean-litter")) : ?>
			<section class="banners">
				<div class="container">
					<div class="row">
						<?php get_template_part('template-parts/banner', null, ['style' => 'blue']); ?>
						<?php get_template_part('template-parts/banner', null, ['style' => 'green']); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

