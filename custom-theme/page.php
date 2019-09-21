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
        <div class="feature-strip1">
            <div class="feature-strip">
                <div style="float:left; width:10%; margin-top:25px; padding-left:30px;">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-e1568384808540.png">
                </div>
                <div style="float:left; width: 20%">
                    <p class="heading2">Advertising</p>
                    <p class="paragraph">
                        Lorem ipsum dolor sit amet. Modi. qui...
                    </p>
                </div>

                <div style="float:left; width:10%; margin-top:25px;padding-left:30px;">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-1-e1568386007173.png">
                </div>
                <div style="float:left; width:20%">
                    <p class="heading2">Multimedia</p>
                    <p class="paragraph">
                        Lorem ipsum dolor sit amet. Modi. qui...
                    </p>
                </div>

                <div style="float:left; width:10%; margin-top:25px;padding-left:30px;">
                    <img src="http://localhost/testsite/wp-content/uploads/2019/09/feature-icons-2-e1568386156700.png">
                </div>
                <div style="float:left; width:20%;">
                    <p class="heading2">Photography</p>
                    <p class="paragraph">
                        Lorem ipsum dolor sit amet. Modi. qui...
                    </p>
                </div>

            </div>
        </div>
        <div class="container">
            <p class="headliner-text">LET'S BLOG</p>
            <hr style="width: 620px;float: left">
            <div class="content-area1">
            <br>
            <br>
            <?php

            $CurrentPage = get_query_var('paged');


            // General arguments

            $Posts = new WP_Query(array(
                'post_type' => 'book', // Default or custom post type
                'posts_per_page' => 3, // Max number of posts per page
                'paged' => $CurrentPage
            ));

            // Content display

            if ($Posts->have_posts()) :
                while ($Posts->have_posts()) :
                    echo "<div class='post-title'>";
                    $Posts->the_post();?>
                    <div class="postdate">
                        <div class="post-title-text day"><?php echo get_the_date(j) ?></div>
                        <div class="post-title-text month"><?php echo get_the_date('M') ?></div>
                    </div>
<?php
                    echo "<p class='vl'></p>";
                    the_title('<p class="post-title-text">','</p>');
                    echo "</div>";
                    echo "<div class='content-area2'>";
                    $image = get_the_post_thumbnail_url();
                    echo "<img class='image' src='$image'>";
                    $excerpt=get_the_excerpt();
                    echo "<p class='excerpt'>".$excerpt."</p>";
                    echo "<p class='read-more'>".the_excerpt()."</p>";
                    echo "</div>";
                endwhile;
            endif;


            // Bottom pagination (pagination arguments)

            echo paginate_links(array(
                'total' => $Posts->max_num_pages,
                'prev_text' => __('<'),
                'next_text' => __('>')
            ));
            ?>
            </div>
        </div>


    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();