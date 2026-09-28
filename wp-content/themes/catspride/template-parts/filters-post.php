<?php
if (!isset($args['taxonomies']) && $args['taxonomies']) return;
$taxonomies = $args['taxonomies'];

$get_params = [];

$params = $_GET ? $_GET : "";

if ($params) {
	foreach ($params as $param => $terms) {
		$param = str_replace('filter-', "",  $param);
		$terms = wp_strip_all_tags($terms);
		if ($param !== 'search' && $param !== 'pageNumber') {

			if ($terms) {
				$get_params[$param] = explode('-', $terms);
			}
		}
	}
}

?>

<div class="post-filters">
	<?php if (!is_home()): ?>
		<div class="post-filters_header">
			<h2 class="title-2"><?php esc_html_e('Filters', 'cats-pride'); ?></h2>
			<a class="primary-button--light-blue" href="#"><?php esc_html_e('Compare', 'cats-pride'); ?></a>
		</div>

	<?php endif; ?>

	<div class="post-filters__top">
		<div class="post-filters__taxonomies">

			<?php foreach ($taxonomies as $taxonomy_name => $terms) :

				$selected_terms_counter = isset($get_params[$taxonomy_name]) ? count($get_params[$taxonomy_name]) : 0;
			?>

				<div taxonomy-name="<?php echo $taxonomy_name;  ?>" class="post-filters__taxonomy">

					<?php if (isset($terms[array_key_first($terms)]['title']) && $terms[array_key_first($terms)]['title']) :
					?>

						<h3 data-taxonomy-name="<?php echo $taxonomy_name; ?>" class="search-tax-title"><?php echo $terms[array_key_first($terms)]['title']; ?> <i class="fa-solid fa-plus"></i></h3>

					<?php endif; ?>

					<?php if ($terms) : ?>

						<div class="post-filters__terms">

							<?php foreach ($terms as $term_ID => $term) :
							?>

								<div class="post-filters__term">
									<input <?php if ($get_params) foreach ($get_params as $taxonomy => $get_param) if ($taxonomy == $taxonomy_name && in_array($term_ID, $get_param)) echo 'checked=checked';  ?> <?php if (isset($children_ID) && $children_ID) echo "data-children=" . implode('-', $children_ID); ?> data-parent="true" data-taxonomy-name="<?php echo $taxonomy_name; ?>" value="<?php echo $term_ID; ?>" type="checkbox" id="<?php echo $term_ID; ?>">
									<label for="<?php echo $term_ID; ?>"><?php echo $term['name'] ?></label>
								</div>

							<?php endforeach; ?>

							<?php if (!is_home()): ?>

								<span class="clear-filters"><?php esc_html_e('Clear Filters', 'cats-pride'); ?></span>

							<?php endif; ?>

						</div>

					<?php endif; ?>
				</div>

			<?php endforeach; ?>

		</div>
	</div>
</div>