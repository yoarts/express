<?php
/**
 * Template Name: Full Width
 */

get_header(); ?>
	<div class="wrap container" role="document">
		<div class="content">
			<div class="content-inner">
				<div class="row">
					<main class="main col-md-12" role="main">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'page' ); ?>
							<?php
								if ( comments_open() || '0' != get_comments_number() ) :
									comments_template();
								endif;
							?>
						<?php endwhile; ?>
					</main>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>