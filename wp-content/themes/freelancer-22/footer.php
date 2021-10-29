  <div class="push"></div>

</div>

<footer class="footer">

	<nav role="navigation">
		<?php
		wp_nav_menu( array(
			'menu'            => 'footer',
			'theme_location'  => 'footer',
			'depth'           => 2,
			'container'       => 'div',
			'container_class' => 'menu-footer',
			'menu_class'      => 'nav-footer'
		) );
		?>
	</nav>

	<div class="container-bottom-scroll-to-top">
		<div class="scroll-to-top"></i></div>
	</div>

	<?php if ( is_active_sidebar( 'social_widget' ) ) : ?>
		<div id="social-widget" role="complementary">
			<?php dynamic_sidebar( 'social_widget' ); ?>
		</div>
	<?php endif; ?>

    <?php if ( is_active_sidebar( 'copyright_widget' ) ) : ?>
        <div id="copyright" role="complementary">
            <?php dynamic_sidebar( 'copyright_widget' ); ?>
        </div>
    <?php endif; ?>


</footer>

<?php wp_footer(); ?>

</body>
</html>
