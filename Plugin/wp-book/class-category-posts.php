<?php
/**
 * Plugin Name
 *
 * @author            Tapan Chudasama
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Display Books of Specific Category
 * Description:       rtCamp Assignment Plugin
 * Version:           1.0.0
 * Author:            Tapan Chudasama
 * Text Domain:       wp-book
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
class Category_Posts extends WP_Widget {

	/**
	 * Category_Posts widget class
	 *
	 * Displays posts from a selected category
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct(
			'widget_category_posts',
			_x( 'Category Posts Widget', 'Category Posts Widget' ),
			[ 'description' => __( 'Display a list of posts from a selected category.' ) ]
		);
		$this->alt_option_name = 'widget_category_posts';

		add_action( 'save_post', [ $this, 'flush_widget_cache' ] );
		add_action( 'deleted_post', [ $this, 'flush_widget_cache' ] );
		add_action( 'switch_theme', [ $this, 'flush_widget_cache' ] );
	}

	/**
	 * Widget Class to output widget.
	 *
	 * @param array $args Arguments.
	 * @param array $instance Instance.
	 */
	public function widget( $args, $instance ) {
		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Category Posts' );
		/** This filter is documented in wp-includes/default-widgets.php */
		$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$cat_id = $instance['cat_id'];

		/**
		 * Filter the arguments for the Category Posts widget.
		 *
		 * @since 1.0.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the category posts.
		 */
		echo $args['before_widget'];
		$term = get_term( $cat_id );

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<?php
		$args = array(
			'post_type' => 'book',
			'tax_query' => array(
				array(
					'taxonomy' => 'book_category',
					'field'    => $cat_id,
					'terms'    => $cat_id,
				),
			),
		);
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) :

				$loop->the_post();
				?>
			<ul>
				<?php
				$allowed_html = array(
					'a'     => array(
						'href' => array(),
					),
					'input' => array(
						'class' => array(),
						'id'    => array(),
						'name'  => array(),
					),
				);
				echo wp_kses( '<a href="' . get_permalink() . '">' . get_the_title() . '</a><br>', $allowed_html );
				?>
			</ul>
				<?php
			endwhile;
		}
		wp_reset_postdata();
		echo $args['after_widget'];
	}

	/**
	 * Update the widget values.
	 *
	 * @param array $new_instance New Instance.
	 * @param array $old_instance Old Instance.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = wp_strip_all_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['cat_id'] = (int) $new_instance['cat_id'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_category_posts'] ) ) {
			delete_option( 'widget_category_posts' );
		}

		return $instance;
	}

	/**
	 * Flush Widget Cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'widget_cat_posts', 'widget' );
	}

	/**
	 * Form to input values
	 *
	 * @param array $instance Instance.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$cat_id = isset( $instance['cat_id'] ) ? absint( $instance['cat_id'] ) : 1;
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_attr( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php echo esc_attr( 'Number of posts to show:' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php echo esc_attr( 'Category Name:' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>">
				<?php
				$taxonomia = array(
					'book_category',
				);
				$args      = array(
					'orderby' => 'count',
					'order'   => 'DESC',
				);
				$terms     = get_terms( $taxonomia, $args );
				foreach ( $terms as $cat ) {
					$selected = ( $cat->term_id === $cat_id ) ? ' selected = "selected" ' : '';
					$option   = '<option ' . $selected . 'value="' . $cat->term_id;
					$option   = $option . '">';
					$option   = $option . $cat->name;
					$option   = $option . '</option>';
					echo $option;
				}
				?>
			</select>
		</p>
		<?php
	}

}

add_action(
	'widgets_init',
	function () {
		register_widget( 'Category_Posts' );
	}
);
