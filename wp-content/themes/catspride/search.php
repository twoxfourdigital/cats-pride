<?php

/**
 * The template for displaying search results pages.
 *
 * @package CatsPride
 */

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="section-search-hero" style="--bg-url: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bluebackground.jpg');">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2><span><?php printf(esc_html__('Search Results for: %s', 'catspride'), '</span><em>' . get_search_query() . '</em>'); ?></h2>
					</div>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Cats-Pride-Header-Image-Cat-Matters-@2x.png">
				</div>
			</div>

		</section>

		<div class="container">
			<?php if (have_posts()) : ?>
				<div class="row search__items">

					<?php

					while (have_posts()) :
						the_post();

						get_template_part('template-parts/content', 'search');

					endwhile;
					?>
				</div>

				<?php catspride_post_navigation(); ?>
			<?php else : ?>

				<?php get_template_part('template-parts/content', 'none'); ?>

			<?php endif; ?>
		</div>

	</main>
</section>
<

	<?php get_footer(); ?>