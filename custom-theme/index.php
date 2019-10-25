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
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/slider-arrows-e1569039346737.png" alt="">
				</div>
				<div class="slider-arrow2">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/slider-arrows-1-e1569039369975.png" alt="">
				</div>
				<div class="slider-text2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium eaque et iusto natus nostrum omnis quia quo.</div>
			</div>
			<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>
			<div class="container">
				<div>
					<p class="headliner-text">D'SIGN IS THE SOUL</p>
					<button class="headliner-button">view more</button>
				</div>
				<hr style="border: 1px solid #62585f">
				<div class="grid-container">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-1.png">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-2.png">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-3.png">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-4.png">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-5.png">
					<img src="http://localhost/testsite/wp-content/uploads/2019/09/image-6.png">
				</div>


			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
