<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php get_template_part('template-parts/feature-strip', get_post_type()) ?>

        <div class="container"><!--Container Starts-->
            <div class="content-area1">
                <p class="headliner-text">LET'S BLOG</p>
                <hr class="hr-post">
            <br>
            <br>
            <?php

            $CurrentPage = get_query_var('paged');


            // General arguments
            $Posts = new WP_Query(array(
                //'post_type' => 'book', // Default or custom post type
                'posts_per_page' => 3, // Max number of posts per page
                'paged' => $CurrentPage
            ));

            // Content display

            if ($Posts->have_posts()) :
                while ($Posts->have_posts()) :
                    $Posts->the_post();
                    $url=get_permalink($Posts->ID);
                    echo "<a href='$url'>";
                    echo "<div class='post-title'>";
                    ?>
                    <div class="postdate">
                        <div class="post-title-text day"><?php echo get_the_date(j) ?></div>
                        <div class="post-title-text month"><?php echo get_the_date('M') ?></div>
                    </div>
<?php
                    echo "<p class='vl'></p>";
                    the_title('<p class="post-title-text">','</p>');
                    echo "</div>";
                    echo "</a>";
                    echo "<div class='content-area2'>";
                            echo "<div class='thumbnail'>";
                                $image = get_the_post_thumbnail_url();
                                echo "<img class='image' src='$image'>";
                            echo "</div>";
                            echo "<div class='post-excerpt'>";
                                $excerpt=get_the_excerpt();
                                echo "<p class='excerpt'>".$excerpt."</p>";
                                echo "<p class='read-more'>".the_excerpt()."</p>";
                            echo "</div>";
                    echo "</div>";
                endwhile;
            endif;


            // Bottom pagination (pagination arguments)
            echo "<div class='pagination'>";
            echo paginate_links(array(
                'total' => $Posts->max_num_pages,
                'prev_text' => __('<'),
                'next_text' => __('>')
            ));
            echo "</div>";
            ?>
            </div>
        </div><!--Container ends-->


    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();