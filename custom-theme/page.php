<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>

			<div class="container"><!--Container Starts-->
				<div class="content-area1">
					<p class="headliner-text">LET'S BLOG</p>
					<hr class="hr-post">
					<br>
					<br>
					<?php
					$current_page = get_query_var( 'paged' );
					// General arguments.
					$myposts = new WP_Query(
						array(
							'posts_per_page' => 3, // Max number of posts per page.
							'paged'          => $current_page,
						)
					);
					// Content display.
					if ( $myposts->have_posts() ) :
						while ( $myposts->have_posts() ) :
							$myposts->the_post();
							$url          = get_permalink( $myposts->ID );
							$allowed_html = array(
								'img' => array(
									'class' => array(),
									'src'   => array(),
								),
								'a'   => array(
									'href' => array(),
								),
							);
							echo wp_kses( "<a href='$url'>", $allowed_html );
							echo "<div class='post-title'>";
							?>
							<div class="postdate">
								<div class="post-title-text day"><?php echo get_the_date( j ); ?></div>
								<div class="post-title-text month"><?php echo get_the_date( 'M' ); ?></div>
							</div>
							<?php
							echo "<p class='vl'></p>";
							the_title( '<p class="post-title-text">', '</p>' );
							echo '</div>';
							echo '</a>';
							echo "<div class='content-area2'>";
							echo "<div class='thumbnail'>";
							$image = get_the_post_thumbnail_url();
							echo wp_kses( "<img class='image' src='$image'>", $allowed_html );
							echo '</div>';
							echo "<div class='post-excerpt'>";
							$excerpt = get_the_excerpt();
							echo "<p class='excerpt'>" . esc_html( $excerpt ) . '</p>';
							echo "<p class='read-more'>" . esc_html( the_excerpt() ) . '</p>';
							echo '</div>';
							echo '</div>';
						endwhile;
					endif;
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
					echo "<div class='pagination'>";
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
			</div><!--Container ends-->


		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();