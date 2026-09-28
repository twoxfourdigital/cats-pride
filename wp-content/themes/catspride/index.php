<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CatsPride
 */

get_header();

use App\Filter\Filter;
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<!-- Page Hero -->
		<?php get_template_part('blocks/page-hero/page-hero') ?>
		<!-- END -->

		<div class="blog">
			<div class="container">
				<div class="blog__inner">
					<div class="blog__filter">
						<?php Filter::sidebar(); ?>
					</div>

					<?php if (have_posts()): ?>

						<div class="blog__items row">
							<?php
							while (have_posts()):
								the_post();
								get_template_part('template-parts/content', 'blog');
							?>

							<?php endwhile; ?>
						</div>

					<?php else : ?>
						<p class="filter-no-items"><?php esc_html_e('There are no results for the set filters.', 'cats-pride') ?></p>

					<?php endif; ?>

					<?php Filter::pagination(); ?>
				</div>

			</div>

			<section class="banners">
				<div class="container">
					<div class="row">
						<?php get_template_part('template-parts/banner', null, ['style' => 'blue']); ?>
						<?php get_template_part('template-parts/banner', null, ['style' => 'green']); ?>
					</div>
				</div>
			</section>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<div class="loader-wrapper">
	<div class="spinner"></div>
</div>

<?php get_footer(); ?>