<?php get_header(); ?>


<div class="content-wrapper single-people first">


    <?php

    while (have_posts()) : the_post();

        $job_title = get_field('job_title');

        ?>

        <h1><?php the_title() ?> <span class="job-title"><?php echo $job_title; ?></span></h1>

        <?php the_post_thumbnail(); ?>

        <div class="content-text"><?php the_content(); ?></div>


    <?php
    endwhile; ?>


</div>
</div>


<?php get_footer(); ?>
