<?php
/**
 * Template Name: Tag Archive
 *
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="content-area1">
				<p class="headliner-text">Tag Archive for Books</p>
				<div class="tagcloud">
					<?php
					wp_tag_cloud(
						array(
							'smallest' => 14, // size of least used tag.
							'largest'  => 30, // size of most used tag.
							'unit'     => 'px', // unit for sizing the tags.
							'number'   => 45, // displays at most 45 tags.
							'order'    => 'ASC', // order tags by ascending order.
							'taxonomy' => 'book_tag',
						)
					);
					?>
				</div>
					<br>
					<br>
					<br>
					<br>
					<br>
					<p class="headliner-text">Tag Archive</p>
					<div class="tagcloud">
						<?php
						wp_tag_cloud(
							array(
								'smallest' => 14, // size of least used tag.
								'largest'  => 30, // size of most used tag.
								'unit'     => 'px', // unit for sizing the tags.
								'number'   => 45, // displays at most 45 tags.
								'order'    => 'ASC', // order tags by ascending order.
							)
						);
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
