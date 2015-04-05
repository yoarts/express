<?php $post_class = has_post_thumbnail() ? 'has-thumbnail' : ''; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php endif; ?>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php express_posted_on(); ?>
		</div>
		<?php endif; ?>
	</header>

	<?php if ( is_search() || has_excerpt() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'express' ); ?></a>
	</div>
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'express' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'express' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'express' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'express' ), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'express' ), __( '1 Comment', 'express' ), __( '% Comments', 'express' ) ); ?></span>
		<?php endif; ?>
	</footer>
</article>
