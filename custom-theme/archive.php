<?php
/**
 * File to display archive pages
 *
 * PHP Version 7
 *
 * @category WordPress
 * @package  Customtheme
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 *
 *
 * Description: rtCamp Assignment Plugin
 * Version: 1.0
 **/

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container">
			<div class="content-area1">
	<?php if ( have_posts() ) : ?>

			<header class="page-header">
		<?php
		the_archive_title( '<p class="headliner-text">', '</p>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
			</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/*
			* Include the Post-Type-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Type name)
			 * and that will be used instead.
			*/
			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;

		the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
			</div>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
