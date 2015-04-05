	<footer class="footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<p>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'express' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'express' ), 'WordPress' ); ?></a>. <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'express' ), '<a href="' . esc_url( 'http://www.yoarts.com/free-responsive-magazine-wordpress-theme/' ).'" title="' . esc_attr__( 'Free Responsive Magazine WordPress Theme' ).'">Express</a>', 'YoArts' ); ?>
				</p>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
