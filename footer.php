	<footer class="footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<p>
					<?php printf( __( 'Copyright &copy; %1s by <a href="%2s">%3s</a>', 'express' ), esc_attr( date( 'Y' ) ), esc_url( home_url( '/' ) ), esc_attr( get_bloginfo( 'name' ) ) ); ?>.
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'express' ), '<a href="' . esc_url( 'http://www.yoarts.com/free-responsive-magazine-wordpress-theme/' ).'" title="' . esc_attr__( 'Free Responsive Magazine WordPress Theme' ).'">Express</a>', 'YoArts' ); ?><br>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'express' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'express' ), 'WordPress' ); ?></a>
				</p>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
