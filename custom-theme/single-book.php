<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DESIGNfly
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>
			<div class="container">
				<div class="content-area1">
					<br>
					<br>

					<?php
					while ( have_posts() ) :
						the_post();
						the_title( '<p class="headliner-text">', '</p>' );
						echo "<p class='author-info'>by <span class='span'>" . esc_html( get_the_author_meta( 'display_name' ) ) . '</span>' .
							' on ' . get_the_date( 'j-M-Y' ) . '</p>';
						echo "<hr class='hr-post' '>";
						designfly_post_thumbnail();
						echo "<div class='post-content'>";
						the_content();
						echo '</div>';
						$mypost_id = get_the_ID();
						$mytags    = get_the_terms( $mypost_id, 'book_tag' );

							$allowed_html = array(
								'img' => array(
									'class' => array(),
									'src'   => array(),
								),
								'a'   => array(
									'href' => array(),
								),
							);

							if ( ! empty( $mytags ) ) {
								echo "<span class='tags-span'>TAGS:</span> ";
								foreach ( $mytags as $mytag ) {
									echo wp_kses( "<a class='tags-link' href='" . esc_url( get_term_link( $mytag ) ) . "'>$mytag->name,</a>", $allowed_html );
								}
							}
							?>
						<div class="author-info">
							<p>Written by:
								<?php the_author_posts_link(); ?></p>
						</div>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					<hr class="hr-post">
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
