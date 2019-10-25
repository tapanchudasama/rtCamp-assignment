<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="slider">
				<div class="slider-text"><p>Gearing up the ideas</p></div>
				<div class="slider-arrow1">
					<!--    Change web address                -->
					<img src="http://3.84.204.21/wp-content/uploads/2019/09/slider-arrows-e1569039346737.png" alt="">
				</div>
				<div class="slider-arrow2">
					<!--    Change Web Address                -->
					<img src="http://3.84.204.21/wp-content/uploads/2019/09/slider-arrows-1-e1569039369975.png" alt="">
				</div>
				<div class="slider-text2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium eaque et iusto natus nostrum omnis quia quo.</div>
			</div>

			<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>
			<div class="container">
				<div>
					<p class="headliner-text">D'SIGN IS THE SOUL</p>
					<!--    Change web address -->
					<a href="http://3.84.204.21/portfolio/"><button class="headliner-button" >view more</button></a>
				</div>
				<hr style="border: 1px solid #62585f">
				<div class="grid-container">
					<?php
					$current_page = get_query_var( 'paged' );
					// General arguments.
					$myposts = new WP_Query(
						array(
							'post_type'      => 'book', // Default or custom post type.
							'posts_per_page' => 6, // Max number of posts per page.
							'paged'          => $current_page,
						)
					);
					if ( $myposts->have_posts() ) :
						while ( $myposts->have_posts() ) :
							$myposts->the_post();
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
							'total'     => $myposts->max_num_pages,
							'prev_text' => __( '<' ),
							'next_text' => __( '>' ),
						)
					),
					$allowed_html
				);
				echo '</div>';
				?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();