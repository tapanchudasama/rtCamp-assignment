<?php
/**
 * Plugin Name: CPT Book, Metabox, Custom taxonomy Book category, Book Tags, Dashboard Widget
 *
 * PHP Version 7
 *
 * @package  WordPress
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * Description: rtCamp Assignment Plugin
 * Version: 1.0
 * Text Domain: wp-book
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Register Custom post type Book
 *
 * @return void
 **/
function codex_book_init() {
	$type   = 'book';
	$labels = array(
		'name'                 => _x( 'Book', 'post type general name', 'wp-book' ),
		'singular_name'        => _x( 'Book', 'post type singular name', 'wp-book' ),
		'menu_name'            => _x( 'Books', 'admin menu', 'wp-book' ),
		'name_admin_bar'       => _x( 'Book', 'add new on admin bar', 'wp-book' ),
		'add_new'              => _x( 'Add New Book', 'book', 'wp-book' ),
		'new_item'             => __( 'New Book', 'wp-book' ),
		'edit_item'            => __( 'Edit Book', 'wp-book' ),
		'view_item'            => __( 'View Book', 'wp-book' ),
		'all_items'            => __( 'View All Books', 'wp-book' ),
		'search_items'         => __( 'Search Books', 'wp-book' ),
		'register_meta_box_cb' => 'add_custom_metaboxes',
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'capability_type'    => 'post',
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'show_in_admin_bar'  => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'has_archive'        => true,
		'menu_position'      => 5,
		'supports'           => array(
			'title',
			'editor',
			'author',
			'comments',
			'thumbnail',
		),
	);
	register_post_type( $type, $args );
}
add_action( 'init', 'codex_book_init' );

/**
 * Rewrite Flush function
 *
 * @return void
 **/
function my_rewrite_flush() {
	codex_book_init();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

/**
 * Callback for Metabox
 *
 * @param object $object Object.
 *
 * @return void
 */
function meta_information( $object ) {
	wp_nonce_field( 'metabox-nonce', 'metabox-nonce' );
	?>
<div>
	<label for="meta-box-author">Author</label>
	<input name="meta-box-author" type="text"
		value="<?php echo esc_attr( get_post_meta( $object->ID, 'meta-box-author', true ) ); ?>">
	<br>
	<label for="meta-box-price">Price</label>
	<input name="meta-box-price" type="number" min='1' , step="any"
		value="<?php echo esc_attr( get_post_meta( $object->ID, 'meta-box-price', true ) ); ?>">
	<br>
	<label for="meta-box-edition">Edition</label>
	<input name="meta-box-edition" type="number"
		value="<?php echo esc_attr( get_post_meta( $object->ID, 'meta-box-edition', true ) ); ?>">
	<br>
	<label for="meta-box-publisher">Publisher</label>
	<input name="meta-box-publisher" type="text" value="
		<?php echo esc_attr( get_post_meta( $object->ID, 'meta-box-publisher', true ) ); ?>">
	<br>
</div>
	<?php
}

/**
 * Save custom Metabox
 *
 * @param int $post_id Post ID.
 * @param int $post    Post.
 *
 * @return int
 */
function save_custom_metabox( $post_id, $post ) {
	if ( ! empty( sanitize_text_field( wp_unslash( $_POST['metabox-nonce'] ) ) )
		|| wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['metabox-nonce'] ) ), 'metabox-nonce' ) ) {
		return $post_id;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	$slug = 'book';
	if ( $slug !== $post->post_type ) {
		return $post_id;
	}
	$fields = [
		'meta-box-author',
		'meta-box-price',
		'meta-box-edition',
		'meta-box-publisher',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
}
add_action( 'save_post', 'save_custom_metabox', 1, 2 );

/**
 * Add Custom Metabox
 *
 * @return void
 **/
function add_custom_metaboxes() {
	add_meta_box(
		'custom_metabox',
		'Book Information',
		'meta_information',
		'book',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'add_custom_metaboxes' );

/**
 * Register custom hierarchical taxonomy Book category
 *
 * @return void
 **/
function register_taxonomy_book_category() {
	$labels = [
		'name'              => _x( 'Book Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Book Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Book Category' ),
	];
	$args   = [
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'book_category' ],
	];
	register_taxonomy( 'book_category', array( 'book' ), $args );
}
add_action( 'init', 'register_taxonomy_book_category' );

/**
 * Register custom non hierarchical taxonomy Book tags
 *
 * @return void
 **/
function create_book_taxonomies() {
	$labels = array(
		'name'                       => _x( 'Book Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'Book Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Tags' ),
		'popular_items'              => __( 'Popular Tags' ),
		'all_items'                  => __( 'All Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag' ),
		'update_item'                => __( 'Update Tag' ),
		'add_new_item'               => __( 'Add New Tag' ),
		'new_item_name'              => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
		'add_or_remove_items'        => __( 'Add or remove tags' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags' ),
		'not_found'                  => __( 'No tags found.' ),
		'menu_name'                  => __( 'Book Tags' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'book_tag' ),
	);
	register_taxonomy( 'book_tag', 'book', $args );
}
add_action( 'init', 'create_book_taxonomies', 0 );


?>
<?php

/**
 * DASHBOARD WIDGET THAT SHOWS TOP 5 CATEGORIES.
 **/

/**
 * Function that outputs the contents of widget.
 *
 * @param post  $post          Post.
 * @param array $callback_args callback arguments.
 *
 * @return void
 */
function dashboard_widget_function( $post, $callback_args ) {
	$taxonomia = array(
		'book_category',
	);
	$args      = array(
		'orderby' => 'count',
		'order'   => 'DESC',
	);
	$terms     = get_terms( $taxonomia, $args );
	?>
<ul>
	<h3><strong>Category - Count</strong></h3>
	<?php
	foreach ( $terms as $term ) {
		$cat = get_category( $term );
		?>
	<li>
		<?php
		echo esc_html( $cat->name );
		echo '  ';
		echo esc_html( $cat->count )
		?>
	</li>
		<?php
	}
	?>
</ul>
	<?php
}

/**
 * Add dashboard widget
 *
 * @return void
 */
function add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'dashboard_widget',
		'Top 5 Book categories',
		'dashboard_widget_function'
	);
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );



