<?php

/**
 * Template Name: Book
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
                <div>
                    <p class="headliner-text">DESIGN IS THE SOUL</p>
                    <div style="float: right; margin-top: -40px">
                    <button class="portfolio-buttons">Advertising</button>
                    <button class="portfolio-buttons">Multimedia</button>
                    <button class="portfolio-buttons">Photography</button>
                    </div>
                </div>
                    <hr class="hr-post" style="width:100%">
                    <br>
                    <br>
                    <div class="grid-container">
                        <?php
                        $CurrentPage = get_query_var('paged');


                        // General arguments
                        $Posts = new WP_Query(array(
                            'post_type' => 'book', // Default or custom post type
                            'posts_per_page' => 5, // Max number of posts per page
                            'paged' => $CurrentPage
                        ));

                        if ($Posts->have_posts()) :
                            while ($Posts->have_posts()) :
                                $Posts->the_post();
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                }
                            endwhile;
                        endif;
                        ?>
                    </div>

<?php
                    // Bottom pagination (pagination arguments)
                    echo "<div class='pagination' style='margin-left:-0px; margin-top: 2%'>";
                    echo paginate_links(array(
                        'total' => $Posts->max_num_pages,
                        'prev_text' => __('<'),
                        'next_text' => __('>')
                    ));
                    echo "</div>";
                    ?>
            </div><!--Container ends-->


        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();