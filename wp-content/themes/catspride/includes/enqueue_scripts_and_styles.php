<?php

/**
 * Enqueue custom scripts and styles.
 */
function custom_scripts_and_styles()
{

	$theme_options = array();

	if (defined('ACF_GOOGLE_API_KEY')) {
		$theme_options['google_api_key'] = ACF_GOOGLE_API_KEY;
	}

	wp_localize_script('main', 'theme', $theme_options);

	wp_register_script(
		'bazaarvoice-script',
		'https://apps.bazaarvoice.com/deployments/catspride/main_site/production/en_US/bv.js',
		[],
		null, 
		true  
	);

	add_filter('script_loader_tag', function ($tag, $handle) {
		if ('bazaarvoice-script' !== $handle) {
			return $tag;
		}
		return str_replace(' src', ' async src', $tag);
	}, 10, 2);

	wp_enqueue_script('bazaarvoice-script');
	
	// Enqueue main stylesheet (style.css)
	wp_enqueue_style('catspride-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles');

/**
 * Global JS Object
 */

add_action('wp_head', 'global_js_object', 1);

function global_js_object()
{

	$global_js_object = array(
		'ajaxUrl' 		=> admin_url('admin-ajax.php'),
		'nonce'	  		=> wp_create_nonce('security'),
		'postType'		=> get_post_type()
	);

	$global_js_object = json_encode($global_js_object);

	echo "<script>
			const theme = " . $global_js_object . "
		  </script>";
}
