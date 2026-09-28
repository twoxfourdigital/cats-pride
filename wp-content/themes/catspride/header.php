<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CatsPride
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
	<?php include_once(get_template_directory() . '/includes/fonts.php'); ?>
	<meta name="theme-color" content="#010101">

	<?php
	if (
		(function_exists('is_product') && is_product())
	) {
		$product = [
			"id" => get_field("bazaarvoice_product_id", false, false),
			"name" => trim(json_encode(get_the_title()), '"'),
			"image" => trim(json_encode(get_the_post_thumbnail_url()), '"'),
			"url" => trim(json_encode(get_permalink()), '"'),
			"description" => trim(json_encode(wp_strip_all_tags(preg_replace("/\s*<ul[^>]*>[\S\s]*?<\/ul>\s*/", "", get_the_content()))), '"'),
			"brand" => "Cats Pride"
		];
		?>
		<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "Product",
						"@id": "<?php echo $product['url']; ?>",
						"name": "<?php echo $product['name']; ?>",
						"image": "<?php echo $product['image']; ?>",
						"description": "<?php echo $product['description']; ?>",
						"brand": "<?php echo $product['brand']; ?>"
					}
				</script>
		<script async type="text/javascript">
			window.bvDCC = {
				catalogData: {
					locale: "en_US",
					catalogProducts: [{
						"productId": "<?php echo $product['id']; ?>",
						"productName": "<?php echo $product['name']; ?>",
						"productDescription": "<?php echo $product['description']; ?>",
						"productImageURL": "<?php echo $product['image']; ?>",
						"productPageURL": "<?php echo $product['url']; ?>",
						"brandName": "<?php echo $product['brand']; ?>"
					}]
				}
			};

			window.bvCallback = function (BV) {
				BV.pixel.trackEvent("CatalogUpdate", {
					type: 'Product',
					locale: window.bvDCC.catalogData.locale,
					catalogProducts: window.bvDCC.catalogData.catalogProducts
				});

				// trackPageView for Product pages
				BV.pixel.trackPageView({
					"bvProduct": "RatingsAndReviews",
					"productId": window.bvDCC.catalogData.catalogProducts[0].productId
				});

				// Track interactions on Reviews/QA containers
				document.body.addEventListener('click', function (event) {
					var target = event.target;
					if (target.closest('.reviews-wrapper-summary') || target.closest('#rr') || target.closest('#qa')) {
						BV.pixel.trackEvent("Feature", {
							"type": "Used",
							"name": "Interaction",
							"bvProduct": "RatingsAndReviews",
							"productId": window.bvDCC.catalogData.catalogProducts[0].productId
						});
					}
				});
			};
		</script>

	<?php } ?>

	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(), event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-5H7FZ8');
	</script>
	<!-- End Google Tag Manager -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=G-P6N6FH5M4Q"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-P6N6FH5M4Q');
	</script>
	<style>
		.product-highlights__items.row {
			justify-content: center;
		}

		.woocommerce .site-main .product .product-sizes .product-sizes__right img {
			height: 30px;
		}

		.woocommerce .site-main .product .product-highlights .product-highlights__item img {
			width: 100px;
		}

		@media (min-width: 1025px) {
			.archive-product-hero {
				min-height: 450px;
			}
		}

		@media (max-width: 550px) {
			body .archive-product-hero {

				background-size: 210% auto;
			}
		}

		body.woocommerce-lost-password #primary {
			margin-top: 50px;
		}
	</style>
				<!-- Start of HubSpot Embed Code -->
				<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/44089268.js"></script>
			<!-- End of HubSpot Embed Code -->
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="header-top-bar">
				<div class="container">
					<div class="header-top-bar-wrapper">

						<div class="top-bar-text">
							<?php if (!is_user_logged_in()): ?>

								<p><?php _e("Join the Cat's Pride Club and receive coupons and special offers. ", "catspride"); ?>
								</p>
								<a href="<?php echo esc_url(home_url('/member-dashboard/?tab=register')); ?>">
									<?php _e("Sign Up Now", "catspride") ?> </a>

							<?php else:
								$user = wp_get_current_user();
								?>
								<p>
									<?php
									echo "Welcome back";
									if ($user->user_firstname)
										echo ", " . $user->user_firstname . ". ";
									else
										echo "! ";

									_e("If you would like to view or update your profile, ", "catspride"); ?>
								</p>

								<a
									href="<?php echo esc_url(home_url('/member-dashboard')); ?>"><?php _e("click here.", "catspride") ?></a>

							<?php endif; ?>
						</div>

						<div class="login-member-nav">
							<?php if (!is_user_logged_in()): ?>
								<a href="<?php echo esc_url(home_url('/member-dashboard/?tab=login')); ?>"
									class="login-button">
									<i class="fa-regular fa-circle-user"></i>
									<?php _e("Log In", "catspride") ?>
								</a>
							<?php else:
								$user = wp_get_current_user();
								?>
								<div class="user-button">
									<i class="fa-regular fa-circle-user"></i>
									<?php
									if ($user->user_firstname)
										echo "Hi, " . $user->user_firstname . "!";
									else
										echo "Hi!" ?>
									</div>
									<div class="nav-user-dropdown">
										<a
											href="<?php echo esc_url(home_url('/member-dashboard')); ?>"><?php _e("View Profile", "catspride") ?></a>
									<a
										href="<?php echo esc_url(home_url('/member-dashboard/edit-account/')); ?>"><?php _e("Edit Profile", "catspride") ?></a>
									<a
										href="<?php echo esc_url(home_url('/member-dashboard/customer-logout/')); ?>"><?php _e("Log Out", "catspride") ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="logo-menu-wrapper">
				<div class="container">
					<div class="site-header-inner">

						<?php $logo = get_field('header_logo', 'option'); ?>

						<?php if ($logo): ?>

							<div class="site-branding-main-logo site-branding">
								<div class="site-title">
									<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
										<img src="<?php echo $logo['url']; ?>"
											alt="<?php echo "Welcome to Cat's Pride"; ?>" />
									</a>

								</div>
							</div>

						<?php endif; ?>

						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php

							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id' => 'primary-menu',
									'menu_class' => 'main-header-menu',
									'container_class' => 'main-menu-container'
								)
							);

							?>
							<div class="nav-button-wrapper-mobile">
								<?php
								$find_a_store = get_field("find_a_store_link", "option");
								if ($find_a_store): ?>
									<a class="shop-online-button-mobile header-button"
										href="<?php echo $find_a_store['url']; ?>"><?php echo $find_a_store['title']; ?></a>
								<?php endif; ?>

								<div class="shop-online-wrapper">
									<p class="shop-online-button-mobile list-opener">
										<?php _e("Buy Online", "catspride"); ?>
										<span class="arrow-toggle">
											<i class='fa-solid fa-chevron-down' aria-hidden='true'></i>
										</span>
									</p>
									<div class="shop-online-list">

										<ul>
											<?php if (have_rows('shop_external', 'option')):
												while (have_rows('shop_external', 'option')):
													the_row();

													$shop_link = get_sub_field('shop_link');
													$shop_icon = get_sub_field('shop_icon'); ?>

													<li><a href="<?php echo $shop_link; ?>"><img
																src="<?php echo $shop_icon['url']; ?>"
																alt="<?php echo $shop_icon['title']; ?>"></a></li>

												<?php endwhile;
											endif; ?>

										</ul>
									</div>
								</div>
							</div>
						</nav>

						<div class="nav-button-wrapper">
							<?php
							$find_a_store = get_field("find_a_store_link", "option");
							if ($find_a_store): ?>
								<a class="primary-button header-button"
									href="<?php echo $find_a_store['url']; ?>"><?php echo $find_a_store['title']; ?></a>
							<?php endif; ?>

							<div class="shop-online-wrapper">
								<p class="primary-button header-button shop-online-button">
									<?php _e("Buy Online", "catspride"); ?>
								</p>
								<div class="shop-online-list">

									<ul>
										<?php if (have_rows('shop_external', 'option')):
											while (have_rows('shop_external', 'option')):
												the_row();

												$shop_link = get_sub_field('shop_link');
												$shop_icon = get_sub_field('shop_icon'); ?>

												<li><a href="<?php echo $shop_link; ?>"><img
															src="<?php echo $shop_icon['url']; ?>"
															alt="<?php echo $shop_icon['title']; ?>"></a></li>

											<?php endwhile;
										endif; ?>
									</ul>
								</div>
							</div>

							<button class="search-open" aria-label="Search Button"><i
									class="fa-solid fa-magnifying-glass"
									style="color: #1460aa; font-size: 20px"></i></button>
						</div>


						<div class="menu-toggle-wrapper">
							<a href='#' class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"
								aria-label="Mobile Menu">
								<span></span>
								<span></span>
								<span></span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="search-popup">
				<span class="search-close" title="Close Overlay">×</span>
				<div class="search-overlay-content">

					<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
						<label>
							<input type="search" class="search-field"
								placeholder="<?php esc_html_e('Type and Press “enter” to Search', 'catspride'); ?>"
								value="<?php echo get_search_query(); ?>" name="s" />
						</label>
					</form>

				</div>
			</div>
		</header>

		<div id="content" class="site-content">