<?php

/**
 * The template for displaying all single posts.
 *
 * @package CatsPride
 */

get_header(); ?>

<div class="container">
	<div class="row single-blog-page">
		<div id="primary" class="content-area col-md-8">
			<main id="main" class="site-main" role="main">

				<?php
				while (have_posts()) :
					the_post();
					$main_blog_image = get_the_post_thumbnail(get_the_ID(), 'large'); ?>

					<div class="main-blog-thumbnail">
						<?php echo $main_blog_image; ?>
					</div>

				<?php

					get_template_part('template-parts/content', 'single');

				endwhile;
				?>

			</main>
		</div>
		<div class="right-sidebar col-md-4">
			<div class="banners">
				<div class="container">
					<div class="row">
						<?php get_template_part('template-parts/banner', null, ['style' => 'blue']); ?>
						<?php get_template_part('template-parts/banner', null, ['style' => 'green']); ?>
					</div>
				</div>
			</div>

			<div class="recomended-product-wrapper">
				<div class="recomended-product__inner">
					<h3 class="title-third"><?php _e("Recommended Product", "catspride") ?></h3>

					<?php
					$args = array(
						'post_type'           => 'product',
						'posts_per_page'      => 1,
						'orderby'             => 'name',
						'order'               => $order == 'asc' ? 'asc' : 'desc',
						'post__in'            => wc_get_featured_product_ids(),
					);

					$query = new WP_Query($args);

					if ($query->have_posts()) :
						while ($query->have_posts()) :
							$query->the_post();

							$main_product_image = get_the_post_thumbnail(get_the_ID(), 'large'); ?>

							<a href="<?php the_permalink(); ?>">
								<?php echo $main_product_image; ?>
								<div class="single-product-content">
									<h4><?php the_title() ?></h4>
									<div class='post-content'><?php the_excerpt() ?></div>
								</div>
							</a>
					<?php
						endwhile;
					endif;

					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>