<?php get_header(); ?>
	<div class="wrap container" role="document">
		<div class="content">
			<div class="content-inner">
				<div class="row">
					<main class="main col-md-8" role="main">
						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
							<?php the_posts_pagination( array( 'mid_size' => 3 ) ); ?>
						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					</main>
					<aside class="sidebar col-md-4" role="complementary">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
