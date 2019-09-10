<?php
include 'options.php';
/**
 * Plugin Name: WP-Book
 * Plugin URI: http://localhost/testsite/
 * Description: rtCamp Assignment Plugin
 * Version: 1.0
 * Text Domain: my-plugin
 * Author: Tapan Chudasama
 * Author URI: http://inflamesite.wordpress.com
 */

// Register custom post type Book
function codex_book_init()
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
        'supports'           => array('title', 'editor', 'author', 'thumbnail'),
    );
    register_post_type($type, $args);
}
add_action('init', 'codex_book_init');