<?php get_header(); ?>

<div class="content-wrapper first">

    <h1>Blog</h1>

    <?php if (have_posts()) : while (have_posts()) :
    the_post();
    $post_categories = get_the_category_list(', ', get_the_ID());
    $the_title = get_the_title();
    $the_title = strlen($the_title) > 80 ? substr($the_title, 0, 80) . "..." : $the_title;
    ?>
    <article class="blog-item">

        <a href="<?php echo get_permalink(get_the_ID()); ?>"
           class="blog-title"><?php echo $the_title; ?></a><br/>


        <ul class="blog-item-info blog-item-info-archive">
            <li><span class="blog-date">  <?php the_time('F j, Y'); ?>,</span></li>
            <li><span class="blog-author"> By <?php the_author(); ?></span></li>
            <li class="clear-left"><span class="blog-categories">  <?php echo $post_categories; ?></span></li>
        </ul>

</div>

    </article>
<?php endwhile;
else: ?>

    <p>Sorry, no posts to list</p>

<?php endif; ?>

<?php if (is_active_sidebar('primary_sidebar')) : ?>
    <?php dynamic_sidebar('primary_sidebar'); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>

