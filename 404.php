<?php get_header(); ?>
	<div class="wrap container" role="document">
		<div class="content">
			<div class="content-inner">
				<div class="row">
					<main class="main col-md-8" role="main">
						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'express' ); ?></h1>
							</header>
							<div class="page-content">
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'express' ); ?></p>
								<?php get_search_form(); ?>
								<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
								<?php if ( express_categorized_blog() ) : ?>
								<div class="widget widget_categories">
									<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'express' ); ?></h2>
									<ul>
									<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
									?>
									</ul>
								</div>
								<?php endif; ?>
								<?php
								$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'express' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
								?>
								<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
							</div>
						</section>
					</main>
					<aside class="sidebar col-md-4" role="complementary">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>