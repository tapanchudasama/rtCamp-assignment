<?php
/**
 * Template for displaying header
 *
 * PHP Version 7
 *
 * @category File
 * @package  WordPress
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 * Version: 1.0
 **/

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'custom-theme' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$designfly_description = get_bloginfo( 'description', 'display' );
				if ( $designfly_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo esc_html( $designfly_description ); ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div class="menu-right">
				<button class="menu-toggle" aria-controls="primary-menu"
						aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'custom-theme' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);

				?>
				<label>
					<input type="text" name="search" class="search">
				</label>
<!--                Change web address here -->
				<input id="search-image" type="image"
					src="http://3.84.204.21/wp-content/uploads/2019/09/search-icon-e1568373858382.png" alt="">
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
