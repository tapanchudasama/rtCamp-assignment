<?php
/**
 * Display Book by Category Sidebar Widget
 *
 * PHP Version 7
 *
 * @category Plugin
 * @package  Wpbook
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 * Version: 1.0
 * Text Domain: wp-book
 **/

class List_Books extends WP_Widget
{
    /**
     * List_Books function
     *
     * @return void
     **/
    public function List_Books()
    {
        parent::WP_Widget(false, $name = 'Show books by category');
    }

    /**
     * Widget function
     *
     * @param Array    $args     Arguments for widget
     * @param Instance $instance Instance of widget
     *
     * @return void
     */
    public function widget($args, $instance)
    {
        extract($args);
        $title         = apply_filters('widget_title', $instance['title']);
        $number     = $instance['number'];

        $query = new WP_Query(
            array(
            'post_type' => 'book',
            'post_status' => 'publish',
            'taxonomy' => 'book_category'
            )
        );
        $before_widget;
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID(); ?>
            <ul>
            <?php
                echo '<li><a href="' .
                get_permalink($post_id) . '">' .
                get_the_title($post_id) . '</a></li>'; ?>
            </ul>
            <?php
        }
        $after_widget;
        echo $after_widget;
        wp_reset_query();
    }

    /**
     * Update function
     *
     * @param object $new_instance New Instance
     * @param object $old_instance Old Instance
     *
     * @return object
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['taxonomy'] = $new_instance['taxonomy'];
        return $instance;
    }

    /**
     * Form function
     *
     * @param object $instance Instance
     *
     * @return void
     */
    public function form($instance)
    {
        $title = esc_attr($instance['title']);
        $number = isset($instance['number']) ? absint($instance['number']) : 5; ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title:'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                type="text"
                value="<?php echo $title; ?>" />
        </p>

        <p>
            <label><?php _e('Number of posts to show:'); ?></label>
            <input class="widefat"
            type="text"
            value="<?php echo $number; ?>" size="3" />
        </p>
        <?php
    }
}
add_action(
    'widgets_init',
    create_function('', 'return register_widget("List_Books");')
);
?>
<?php

/**
 * DASHBOARD WIDGET THAT SHOWS TOP 5 CATEGORIES
 **/

/**
 * Function that outputs the contents of widget
 *
 * @param post  $post          Post
 * @param array $callback_args callback arguments
 *
 * @return void
 */
function Dashboard_Widget_function($post, $callback_args)
{
    $taxonomia = array(
        'book_category'
    );
    $args = array(
        'orderby' => 'count',
        'order' => 'DESC'
    );
    $terms = get_terms($taxonomia, $args); ?>
    <ul>
    <h3><strong>Category - Count</strong></h3>
    <?php
    foreach ($terms as $term) {
        $cat = get_category($term); ?>
    <li>
        <?php
                echo $cat->name;
        echo '  ';
        echo $cat->count ?>
    </li>
        <?php
    } ?>
    </ul>
    <?php
}

/**
 * Add dashboard widget
 *
 * @return void
 */
function Add_Dashboard_widgets()
{
    wp_add_dashboard_widget(
        'dashboard_widget',
        'Top 5 Book categories',
        'Dashboard_Widget_function'
    );
}
    add_action('wp_dashboard_setup', 'Add_Dashboard_widgets');

/**
 * Plugin to display CATEGORIES on sidebar
 *
 * Plugin Name: Display Book by Category
 *
 * PHP Version 7
 *
 * @category Plugin
 * @package  Wpbook
 * @author   Tapan Chudasama <tapan9740@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/testsite/
 * Version: 1.0
 **/
class List_Categories_Widget extends WP_Widget
{
    /**
     * Constructor
     *
     * @return void
     **/
    public function List_Categories_Widget()
    {
        parent::WP_Widget(false, $name = 'List Categories');
    }

    /**
     * Widget function
     *
     * @param Array    $args     Arguments
     * @param Instance $instance Instance
     *
     * @return void
     * @see    WP_Widget::widget -- do not rename this
     */
    public function widget($args, $instance)
    {
        extract($args);
        $title         = apply_filters('widget_title', $instance['title']);
        $number     = $instance['number']; // the number of categories to show
        $taxonomy     = 'book_category';

        $args = array(
                'number'     => $number,
                'taxonomy'    => $taxonomy
            );

        // retrieves an array of categories or taxonomy terms
        $cats = get_categories($args); ?>
        <?php echo $before_widget; ?>
        <?php if ($title) {
            echo $before_title . $title . $after_title;
        } ?>
        <ul>
        <?php foreach ($cats as $cat) { ?>
        <li>
            <a href="<?php echo get_term_link($cat->slug, $taxonomy); ?>"
                title="<?php sprintf(__("View all posts in %s"), $cat->name); ?>">
                <?php echo $cat->name; ?>
            </a>
        </li>
        <?php } ?>
        </ul>
        <?php echo $after_widget;
    }

    /**
     * Update function
     *
     * @param object $new_instance New Instance
     * @param object $old_instance Old Instance
     *
     * @return object
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    /**
     * Form function
     *
     * @param object $instance Instance
     *
     * @return void
     */
    public function form($instance)
    {
        $title         = esc_attr($instance['title']);
        $number        = esc_attr($instance['number']); ?>
        <p>
            <label for="<?php
            echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
            name="<?php echo $this->get_field_name('title'); ?>"
            type="text"
            value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
            <?php _e('Number of categories to display'); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>"
            name=" <?php echo $this->get_field_name('number'); ?>"
            type="text"
            value="<?php echo $number; ?>" />
        </p>
        <?php
    }
} // end class list_categories_widget
add_action(
    'widgets_init',
    create_function(
        '',
        'return register_widget("List_Categories_Widget");'
    )
);
?>