<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DESIGNfly
 */

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('template-parts/feature-strip', get_post_type()) ?>
            <div class="container">
                <div class="content-area1">
                    <br>
                    <br>

                    <?php
                    while ( have_posts() ) :
                        the_post();
                        the_title('<p class="headliner-text">','</p>');
                        echo "<p class='author-info'>by <span class='span'>".get_the_author_meta('display_name', $author_id)."</span>" ." on ".get_the_date('j-M-Y')."</p>";
                        echo "<hr class='hr-post' '>";
                        designfly_post_thumbnail();
                        echo "<div class='post-content'>";
                        the_content();
                        echo "</div>";
                        $post_ID=get_the_ID();
                        $tags = get_the_terms($post_ID,'book_category');

                        if(!empty($tags)){
                            echo "<span class='tags-span'>TAGS:</span> ";
                            foreach ($tags as $tag){
                                echo "<a class='tags-link' href='".get_term_link($tag)."'> "." $tag->name,</a>";
                            }
                        }
                        ?>
                        <div class="author-info">
                            <p>Written by:
                                <?php the_author_posts_link(); ?></p>
                        </div>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                    <hr class="hr-post">
                </div>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
