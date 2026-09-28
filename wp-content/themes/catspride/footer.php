<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package CatsPride
 */
?>
</div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-top-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php $footer_join_the_club = get_field("footer_join_the_club", "option");
					if ($footer_join_the_club) : ?>
						<h4 class="footer-title"><?php echo $footer_join_the_club; ?></h4>
					<?php endif; ?>

					<?php $sign_up_button = get_field("sign_up_button", "option");
					if ($sign_up_button) : ?>
						<a class="primary-button--light-blue" href="<?php echo $sign_up_button['url']; ?>"><?php echo $sign_up_button['title']; ?></a>
					<?php endif; ?>
				</div>

				<div class="col-md-4">
					<?php $social_media_text = get_field("social_media_text", "option");
					if ($social_media_text) : ?>
						<h4 class="footer-title"><?php echo $social_media_text; ?></h4>
					<?php endif; ?>

					<?php if (have_rows("social_media_links", "option")) : ?>
						<div class="social-media-inner-wrapper">
							<?php while (have_rows("social_media_links", "option")) : the_row("social_media_links", "option");
								$social_media_link = get_sub_field("social_media_link");
								$social_media_choice = get_sub_field("social_media_choice");

								$social_media_name = "";
								if ($social_media_choice === "Facebook") :
									$social_media_name = "facebook";
								elseif ($social_media_choice === "Twitter") :
									$social_media_name = "twitter";

								elseif ($social_media_choice === "Youtube") :
									$social_media_name = "youtube";

								elseif ($social_media_choice === "Instagram") :
									$social_media_name = "instagram";

								elseif ($social_media_choice === "Pinterest") :
									$social_media_name = "pinterest";

								endif;


								if ($social_media_link) :
							?>

									<div class="social-media-item">
										<a href="<?php echo $social_media_link; ?>" aria-label="<?php echo $social_media_name; ?>">
											<i class="fa-brands fa-<?php echo $social_media_name; ?>"></i>
										</a>
									</div>
							<?php
								endif;
							endwhile; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="col-md-2">
					<?php wp_nav_menu(
						array(
							'theme_location' 		=> 	'footer-menu-one',
							'menu_id' 				=> 	'footer-menu-one',
							'menu_class' 			=> 	'first-footer-menu',
							'container_class'		=>	'first-menu-container'
						)
					); ?>
				</div>

				<div class="col-md-2">
					<?php wp_nav_menu(
						array(
							'theme_location' 		=> 	'footer-menu-two',
							'menu_id' 				=> 	'footer-menu-two',
							'menu_class' 			=> 	'second-footer-menu',
							'container_class'		=>	'second-menu-container'
						)
					); ?>
				</div>

			</div>
		</div>
	</div>

	<div class="site-bottom-footer">
		<?php $footer_bottom_bar_text = get_field("footer_bottom_bar_text", "option");
		if ($footer_bottom_bar_text) : ?>
			<div class="site-info">
				<div class="container">
					<div class="footer-copyright col-md-12 align-center"><?php echo $footer_bottom_bar_text; ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</footer>
</div>

<?php wp_footer(); ?>
<script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipYXnSU0ygqeac2q7CVYMbh84q0uHVRRxEtvFPiQYbXWUorga2aqZJ0z"></script>
	<style>
		.catspride-StoreLocatorForm .catspride-StoreLocator-single {
			display: block;
		}
		.menu-toggle-wrapper {
    		z-index: 11;
		}
		@media (max-width: 1199px) {
			.main-navigation {
				z-index: 10;
			}
		}
	</style>

	<script type='text/javascript'>
 window.smartlook||(function(d) {
   var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
   var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
   c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
   })(document);
   smartlook('init', '048b3ff84d74f6722490897ecc50e0e365d6ab45', { region: 'eu' });
</script>

<script>
    (function(e,t,o,n,p,r,i){e.visitorGlobalObjectAlias=n;e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){(e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
    vgo('setAccount', '609803706');
    vgo('setTrackByDefault', true);

    vgo('process');
</script>
</body>

</html>