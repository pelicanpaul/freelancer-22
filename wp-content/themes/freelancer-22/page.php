<?php get_header(); ?>


<?php while ( have_posts() ): the_post() ?>
	<div class="content-wrapper first">
		<h1><?php the_title() ?></h1>

        <div class="content-text <?php /*the_field('content_width');*/ ?>">

		    <?php the_content(); ?>

        </div>


	</div>
<?php endwhile; ?>


<?php get_footer(); ?>

