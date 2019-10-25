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

get_header(); ?>
<?php get_template_part( 'template-parts/feature-strip', get_post_type() ); ?>

	<div id="content" class="narrowcolumn">

		<?php
		$curauth = ( isset( $_GET['author_name'] ) ) ?
			get_user_by( 'slug', $author_name ) :
			get_userdata( intval( $author ) );
		?>
		<div class="container">
			<div class="content-area1">
			<p class="headliner-text">About: <?php echo esc_html( $curauth->nickname ); ?></p>
				<p class="author-info">
					Website:
					<a href="<?php echo esc_url( $curauth->user_url ); ?>">
						<?php
						echo esc_url( $curauth->user_url )
						?>
					</a>
				</p>

			<p class="author-info">Posts by <?php echo esc_html( $curauth->nickname ); ?>:</p>

			<ul class="posts-list">
				<!-- The Loop -->
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark"
								title="Permanent Link: <?php the_title(); ?>">
								<?php the_title(); ?></a>,
							<?php the_time( 'd M Y' ); ?> in <?php the_category( '&' ); ?>
						</li>

						<?php
					}
				} else {
					echo esc_html( 'No posts by this author.' );
				}
				?>
				<!-- End Loop -->

			</ul>
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
