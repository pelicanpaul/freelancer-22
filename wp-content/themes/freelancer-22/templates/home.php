<?php
/**
 * Template Name: Home
 * Description: Home
 */
?>

<?php get_header(); ?>


<?php while ( have_posts() ): the_post() ?>

    <?php
    // background image
    $background_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' ); ?>



	<div class="content-wrapper first" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.4) 46%, rgba(0, 0, 0, 0) 78%), url(<?php echo $background_image ?>) no-repeat center; background-size: cover;">

		<h1 class="hidden"><?php the_title() ?></h1>

        <div class="main-content">

		    <?php the_content(); ?>

        </div>


	</div>
<?php endwhile; ?>


<?php get_footer(); ?>

