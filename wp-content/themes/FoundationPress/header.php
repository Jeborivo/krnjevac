<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
		<link rel="stylesheet" href="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/font-icons/icons.css">
		<script src="wp-content/themes/FoundationPress/js/script.js"></script>
		<script src="wp-content/themes/FoundationPress/js/jquery.js"></script>
		
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>


	<header class="site-header" role="banner">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
				<span class="site-mobile-title title-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
			</div>
		</div>

		<nav class="site-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<div class="site-desktop-title top-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/krnjevac-logo.png" alt="krnjevac"></a>
				</div>
				<?php foundationpress_top_bar_l(); ?>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>
				<div class="search"></div>
				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
				<div class="wrap-search">
					<input id="open" class="search-toggle" type="checkbox">
					<label for="open" class="label-toggle"><i class="icon-search"></i></label>
					<div class="search-content">
						<?php get_search_form(); ?>
					</div>
				</div>

				<a href="#" class="shop"><i class="icon-cart"></i></a>
				<div class="navigation"> 	
            	<input type="checkbox" class="navigation__checkbox" id="navi-toggle">
           		<label for="navi-toggle" class="navigation__button">
                	<span class="navigation__icon">&nbsp;</span>
				</label>
				
            	<div class="navigation__background">
					&nbsp;
				</div>
		
            	<nav class="navigation__nav">
				<?php foundationpress_top_bar_l(); ?>
				<div class="info">
					<h3 class="info_title">Medino DOO Krnjevo</h3>
					<h5 class="info_phone">+381 26 821 080</h5>
					<h5 class="info_mail">office@krnjevac.rs</h5>
					<h5 class="info_adress">Bulevar oslobođenja 29, 11319 Krnjevo, Srbija</h5>
				</div>
				<div class="nav_links">
					<div class="faq-nav">
						<a href="#" class="faq-nav_link">Kontrola kvaliteta</a>
						<a href="#" class="faq-nav_link">Gde kupiti</a>
						<a href="#" class="faq-nav_link">Uslovi korišćenja i prodaje</a>
						<a href="#" class="faq-nav_link">Kako poručiti proizvod</a>
					</div>
					<div class="about">
						<a href="#" class=about_link">Blog</a>
						<a href="#" class=about_link">Naši pčelari</a>
						<a href="#" class=about_link">Projekti</a>
						<a href="#" class=about_link">Recepti</a>
					</div>
					<div class="social">
						<a href="#" class=social_link">Facebook</a>		
						<a href="#" class=social_link">Instagram</a>	
						<a href="#" class=social_link">Youtube</a>	
					</div>
				</div>
            	</nav>
        	</div>


			</div>
		</nav>




	</header>
