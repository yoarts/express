<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-toggle" data-toggle="collapse" data-target=".mainnav">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'express' ); ?></span>
					<i class="fa fa-bars"></i>
				</a>
			</div>

			<nav class="collapse navbar-collapse mainnav">
				<?php
					if (has_nav_menu('primary')) :
						wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav'));
					endif;
				?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php bloginfo('rss_url'); ?>"><i class="fa fa-rss hidden-xs hidden-sm"></i><span class="hidden-md hidden-lg"><?php _e( 'RSS', 'express' ); ?></span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-search hidden-xs hidden-sm"></i><span class="hidden-md hidden-lg"><?php _e( 'Search', 'express' ); ?></span></a>
						<div class="search-form dropdown-menu">
							<?php get_search_form(); ?>
						</div>
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<header class="header" role="banner">
		<div class="container">
			<h1>
				<a href="<?php echo home_url(); ?>/">
					<?php $site_logo = express_get_theme_option('site_logo'); ?>
					<?php if( $site_logo ) : ?>
						<img src="<?php echo esc_url( $site_logo ); ?>" title="<?php bloginfo('name'); ?>">
					<?php else : ?>
						<?php bloginfo('name'); ?>
					<?php endif; ?>
				</a>
			</h1>
		</div>
	</header>
