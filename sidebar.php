<div class="sidebar-inner">
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<section id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</section>

		<section class="widget">
			<h3><?php _e( 'Archives', 'express' ); ?></h3>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</section>

		<section class="widget">
			<h3><?php _e( 'Meta', 'express' ); ?></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</section>

	<?php endif; ?>
</div>