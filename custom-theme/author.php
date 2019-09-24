<?php get_header(); ?>
<?php get_template_part('template-parts/feature-strip', get_post_type()) ?>

    <div id="content" class="narrowcolumn">

        <!-- This sets the $curauth variable -->

        <?php
        $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
        ?>
        <div class="container">
            <div class="content-area1">
            <p class="headliner-text">About: <?php echo $curauth->nickname; ?></p>
                <p class="author-info">Website: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>

            <p class="author-info">Posts by <?php echo $curauth->nickname; ?>:</p>

            <ul class="posts-list">
                <!-- The Loop -->
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                            <?php the_title(); ?></a>,
                        <?php the_time('d M Y'); ?> in <?php the_category('&');?>
                    </li>

                <?php endwhile; else: ?>
                    <p><?php _e('No posts by this author.'); ?></p>

                <?php endif; ?>
                <!-- End Loop -->

            </ul>
            </div>
        </div>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>