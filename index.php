<?php
/*
Plugin Name: Display Book by Category
Plugin URI: http://localhost/testsite/
Version: 1.0
Author: Tapan
Author URI: http://inflamesite.wordpress.com
*/

class list_categories_widget extends WP_Widget
{
    function list_categories_widget()
    {
        parent::WP_Widget(false, $name = 'List Categories');
    }
    function widget($args, $instance)
    {
        extract($args);
        $title         = apply_filters('widget_title', $instance['title']); // the widget title
        $number     = $instance['number']; // the number of categories to show
        $taxonomy     = $instance['taxonomy']; // the taxonomy to display

        $args = array(
            'number'     => $number,
            'taxonomy'    => $taxonomy
        );

        // retrieves an array of categories or taxonomy terms
        $cats = get_categories($args);
        ?>
<?php echo $before_widget; ?>
<?php if ($title) {
                    echo $before_title . $title . $after_title;
                } ?>
<ul>
    <?php foreach ($cats as $cat) { ?>
    <li><a href="<?php echo get_term_link($cat->slug, $taxonomy); ?>"><?php echo $cat->name; ?></a></li>
    <?php } ?>
</ul>
<?php echo $after_widget; ?>
<?php
        }
        /** @see WP_Widget::form -- do not rename this */
        function form($instance)
        {

            $title         = esc_attr($instance['title']);
            $number        = esc_attr($instance['number']);
            $exclude    = esc_attr($instance['exclude']);
            $taxonomy    = esc_attr($instance['taxonomy']);
            ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of categories to display'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>"
        name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Choose the Taxonomy to display'); ?></label>
    <select name="<?php echo $this->get_field_name('taxonomy'); ?>" id="<?php echo $this->get_field_id('taxonomy'); ?>"
        class="widefat" />
    <?php
                    $taxonomies = get_taxonomies(array('public' => true), 'names');
                    foreach ($taxonomies as $option) {
                        echo '<option id="' . $option . '"', $taxonomy == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    ?>
    </select>
</p>
<?php
        }
    } // end class list_categories_widget
    add_action('widgets_init', create_function('', 'return register_widget("list_categories_widget");'));

    // DASHBOARD WIDGET THAT SHOWS TOP 5 CATEGORIES
    // Function that outputs the contents of the dashboard widget
    function dashboard_widget_function($post, $callback_args)
    {
        $taxonomia = array(
            'book_category'
        );
        $args = array(
            'orderby' => 'count',
            'order' => 'DESC'
        );
        $terms = get_terms($taxonomia, $args);
        ?>
<ul>
    <h3><strong>Category - Count</strong></h3>
    <?php foreach ($terms as $term) {
                $cat = get_category($term); ?>
    <li>
        <?php
                        echo $cat->name;
                        echo '  ';
                        echo $cat->count ?>
    </li>
    <?php } ?>
</ul>
<?php
}
function add_dashboard_widgets()
{
    wp_add_dashboard_widget('dashboard_widget', 'Top 5 Book categories', 'dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets');