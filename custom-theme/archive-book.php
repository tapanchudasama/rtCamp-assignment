<?php
/**
 * Template Name: Book
 * The template for displaying all pages
 *
 * PHP Version 7
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @category WordPress
 * @package  DESIGNfly
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>

			<div class="container"><!--Container Starts-->
				<div>
					<p class="headliner-text">DESIGN IS THE SOUL</p>
					<div style="float: right; margin-top: -40px">
						<button class="portfolio-buttons">Advertising</button>
						<button class="portfolio-buttons">Multimedia</button>
						<button class="portfolio-buttons">Photography</button>
					</div>
				</div>
				<hr class="hr-post" style="width:100%">
				<br>
				<br>
				<div class="grid-container">
					<?php
					$current_page = get_query_var( 'paged' );
					// General arguments.
					$posts_all = new WP_Query(
						array(
							'post_type'      => 'book', // Default or custom post type.
							'posts_per_page' => 6, // Max number of posts per page.
							'paged'          => $current_page,
						)
					);
					if ( $posts_all->have_posts() ) :
						while ( $posts_all->have_posts() ) :
							$posts_all->the_post();
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						endwhile;
					endif;
					?>

				</div>

				<?php
				// Bottom pagination (pagination arguments).
				$allowed_html = array(
					'span' => array(
						'aria-current' => array(),
						'class'        => array(),
					),
					'a'    => array(
						'href'  => array(),
						'class' => array(),
					),
				);
				echo "<div class='pagination' style='margin-left:-0px; margin-top: 2%'>";
				echo wp_kses(
					paginate_links(
						array(
							'total'     => $posts_all->max_num_pages,
							'prev_text' => __( '<' ),
							'next_text' => __( '>' ),
						)
					),
					$allowed_html
				);
				echo '</div>';
				?>
			</div><!--Container ends-->


		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();