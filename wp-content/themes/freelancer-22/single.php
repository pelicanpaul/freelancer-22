<?php get_header(); ?>

<div class="content-wrapper first">

    <?php while (have_posts()): the_post() ?>

        <?php $post_categories = get_the_category_list(', ', get_the_ID()); ?>

        <article>

            <h1><?php the_title() ?></h1>
            <ul class="blog-item-info blog-item-info-archive">
                <li><span class="blog-date">  <?php the_time('F j, Y'); ?>,</span></li>
                <li><span class="blog-author"> By <?php the_author(); ?></span></li>
                <li class="clear-left"><span class="blog-categories">  <?php echo $post_categories; ?></span></li>
            </ul>


            <?php
            // check if the post has a Post Thumbnail assigned to it.
            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }
            ?>

            <div class="content-text">
                <?php the_content(); ?>
            </div>
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>


            <?php if (is_active_sidebar('primary_sidebar')) : ?>
                <?php dynamic_sidebar('primary_sidebar'); ?>
            <?php endif; ?>

        </article>

    <?php endwhile; ?>

</div>


<?php get_footer(); ?>

