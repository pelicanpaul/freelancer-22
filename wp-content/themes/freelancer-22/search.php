<?php
/**
 * The template for displaying search results pages.
 *
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>


	<h1 class="search">RESULTS FOR: <?php print  get_search_query(); ?></h1>


	<?php
	global $wp_query;
	$total_results = $wp_query->found_posts;
	?>

	Number of Results: <?php print $total_results ?><br/><br/>


	<form class="search-main" action="/" method="get" role="search" id="searchform">


		<input type="text" name="s" id="s" class="form-control form-search-input"/>


		<input name="submit" type="submit" id="submit" class="submit btn btn-default" value="Search">

	</form>


	<ul class="list-search">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			?>

			<li>


				<a href="<?php echo get_permalink( get_the_ID() ); ?>">
					<div class="item-image"
					     style="background-image: url(<?php echo get_primary_image( get_the_ID(), 'large' ); ?>); background-size: cover; background-position: center center">

					</div>


					<a href="<?php echo get_permalink( get_the_ID() ); ?>"
					   class="blog-title"><?php the_title(); ?></a><br/>


					<p><?php echo get_excerpt( 140 ) ?></p>


			</li>


			<?php
			esc_url( get_permalink() );

			// End the loop.
		endwhile; ?>
	</ul>


	<?php gc_pagination(); ?>


	<?php


// If no content, include the "No posts found" template.
else : ?>


	<h1>Search</h1>
	There were no results for <?php echo get_search_query(); ?>


	<?php
endif;
?>


<?php get_footer(); ?>