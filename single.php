<?php get_header(); ?>
	<div class="wrap container" role="document">
		<div class="content">
			<div class="content-inner">
				<div class="row">
					<main class="main col-md-8" role="main">
						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header">
									<h1 class="entry-title"><?php the_title(); ?></h1>

									<div class="entry-meta">
										<?php express_posted_on(); ?>
									</div>
								</header>

								<div class="entry-content">
									<?php the_content(); ?>
									<?php
										wp_link_pages( array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'express' ),
											'after'  => '</div>',
										) );
									?>
								</div>

								<footer class="entry-footer">
									<?php
										$tags_list = get_the_tag_list( '', __( ', ', 'express' ) );
										if ( $tags_list ) :
									?>
									<span class="tags-links">
										<?php printf( __( 'Tagged %1$s', 'express' ), $tags_list ); ?>
									</span>
									<?php endif; ?>
								</footer>
							</article>

							<div class="author-info panel panel-default">
								<div class="panel-body">
									<div class="media">
										<div class="author-avatar media-left">
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
											</a>
										</div>
										<div class="author-description media-body">
											<h4 class="media-heading"><?php echo get_the_author(); ?></h4>
											<?php echo wp_kses( get_the_author_meta( 'description' ), wp_kses_allowed_html( 'pre_user_description' ) ); ?>
										</div>
									</div>
								</div>
							</div>
							<?php the_post_navigation(); ?>
							<?php
								if ( comments_open() || '0' != get_comments_number() ) :
									comments_template();
								endif;
							?>
						<?php endwhile;?>
					</main>
					<aside class="sidebar col-md-4" role="complementary">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
