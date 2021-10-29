<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *

 */
?>

<?php get_header(); ?>


<div class="first-section">
	<div class="content-wrapper">


			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$post_categories = get_the_category_list( ', ', get_the_ID() );
				$the_title       = get_the_title();
				$the_title       = strlen( $the_title ) > 80 ? substr( $the_title, 0, 80 ) . "..." : $the_title;
				?>
				<article>


<!--					<a href="<?php /*echo get_permalink( get_the_ID() ); */?>"
					   class="blog-title"><?php /*echo $the_title; */?></a><br/>


					<ul>
						<li><span class="blog-date">  <?php /*the_time( 'F j, Y' ); */?></span></li>
						<li><span class="blog-author">  <?php /*the_author(); */?></span></li>
						<li><span class="blog-categories">  <?php /*echo $post_categories; */?></span></li>
					</ul>-->


				</article>
			<?php endwhile;
			else: ?>

				<p>Sorry, no posts to list</p>

			<?php endif; ?>


	</div>
</div>

<?php get_footer(); ?>


