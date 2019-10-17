<?php
/**
 * Plugin Name: WP-Book
 *
 * PHP Version 7
 *
 * @category Plugin
 * @package  Wpbook
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 * Description: rtCamp Assignment Plugin
 * Version: 1.0
 * Text Domain: custom-plugin
 * Author: Tapan Chudasama
 **/

/**
 * Register custom post type Book
 *
 * @return void
 **/
function Codex_Book_init()
{
    $type = 'book';
    $labels = array(
        'name'               => _x('Book', 'post type general name', 'my-plugin'),
        'singular_name'      => _x('Book', 'post type singular name', 'my-plugin'),
        'menu_name'          => _x('Books', 'admin menu', 'my-plugin'),
        'name_admin_bar'     => _x('Book', 'add new on admin bar', 'my-plugin'),
        'add_new'            => _x('Add New Book', 'book', 'my-plugin'),
        'new_item'           => __('New Book', 'my-plugin'),
        'edit_item'          => __('Edit Book', 'my-plugin'),
        'view_item'          => __('View Book', 'my-plugin'),
        'all_items'          => __('View All Books', 'my-plugin'),
        'search_items'       => __('Search Books', 'my-plugin'),
        'register_meta_box_cb' => 'add_custom_metaboxes',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'capability_type'   =>  post,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'book'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_position'      => 5,
        'supports'           => array(
            'title',
            'editor',
            'author',
            'comments',
            'thumbnail'
        ),
    );
    register_post_type($type, $args);
}
add_action('init', 'Codex_Book_init');

/**
 * Rewrite Flush function
 *
 * @return void
 **/
function My_Rewrite_flush()
{
    Codex_Book_init();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'My_Rewrite_flush');

/**
 * Callback for Metabox
 *
 * @param object $object Object
 *
 * @return void
 */
function Meta_information($object)
{
    ?>
<div>
    <label for="meta-box-author">Author</label>
    <input name="meta-box-author" type="text"
        value="<?php echo get_post_meta($object->ID, "meta-box-author", true); ?>">
    <br>
    <label for="meta-box-price">Price</label>
    <input name="meta-box-price" type="number" min='1' , step="any"
        value="<?php echo get_post_meta($object->ID, "meta-box-price", true); ?>">
    <br>
    <label for="meta-box-edition">Edition</label>
    <input name="meta-box-edition" type="number"
        value="<?php echo get_post_meta($object->ID, "meta-box-edition", true); ?>">
    <br>
    <label for="meta-box-publisher">Publisher</label>
    <input name="meta-box-publisher" type="text" value="
        <?php echo get_post_meta($object->ID, "meta-box-publisher", true); ?>">
    <br>
</div>
    <?php
}

/**
 * Save custom metabox
 *
 * @param int $post_id Post ID
 * @param int $post    Post
 *
 * @return int
 */
function Save_Custom_metabox($post_id, $post)
{
    if (!current_user_can("edit_post", $post_id)) {
        return $post_id;
    }
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }
    $slug = "book";
    if ($slug != $post->book) {
        return $post_id;
    }
    $fields = [
        'meta-box-author',
        'meta-box-price',
        'meta-box-edition',
        'meta-box-publisher'
    ];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action("save_post", "Save_Custom_metabox", 1, 2);

/**
 * Add Custom Metabox
 *
 * @return void
 **/
function Add_Custom_metaboxes()
{
    add_meta_box(
        'custom_metabox',
        'Book Information',
        'meta_information',
        'book',
        'side',
        'high'
    );
}
add_action("add_meta_boxes", "Add_Custom_metaboxes");

/**
 * Register custom hierarchical taxonomy Book category
 *
 * @return void
 **/
function Register_Taxonomy_Book_category()
{
    $labels = [
        'name'              => _x('Book Category', 'taxonomy general name'),
        'singular_name'     => _x('Book Category', 'taxonomy singular name'),
        'search_items'      => __('Search Categories'),
        'all_items'         => __('All Categories'),
        'parent_item'       => __('Parent Category'),
        'parent_item_colon' => __('Parent Category:'),
        'edit_item'         => __('Edit Category'),
        'update_item'       => __('Update Category'),
        'add_new_item'      => __('Add New Category'),
        'new_item_name'     => __('New Category Name'),
        'menu_name'         => __('Book Category'),
    ];
    $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'book_category'],
    ];
    register_taxonomy('book_category', array('book'), $args);
}
add_action('init', 'Register_Taxonomy_Book_category');

/**
 * Register custom non hierarchical taxonomy Book tags
 *
 * @return void
 **/
function Create_Book_taxonomies()
{
    $labels = array(
        'name'                       => _x('Book Tags', 'taxonomy general name'),
        'singular_name'              => _x('Book Tag', 'taxonomy singular name'),
        'search_items'               => __('Search Tags'),
        'popular_items'              => __('Popular Tags'),
        'all_items'                  => __('All Tags'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Tag'),
        'update_item'                => __('Update Tag'),
        'add_new_item'               => __('Add New Tag'),
        'new_item_name'              => __('New Tag Name'),
        'separate_items_with_commas' => __('Separate tags with commas'),
        'add_or_remove_items'        => __('Add or remove tags'),
        'choose_from_most_used'      => __('Choose from the most used tags'),
        'not_found'                  => __('No tags found.'),
        'menu_name'                  => __('Book Tags'),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'book_tag'),
    );
    register_taxonomy('book_tag', 'book', $args);
}
add_action('init', 'Create_Book_taxonomies', 0);
