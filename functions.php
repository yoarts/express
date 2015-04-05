<?php
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/nav.php';

if ( ! function_exists( 'express_setup' ) ) :
function express_setup() {
  load_theme_textdomain( 'express', get_template_directory() . '/languages' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'title-tag' );
  add_editor_style( array( 'assets/css/editor-style.css' ) );
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'express' ),
  ) );
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
  ) );
}
endif;
add_action( 'after_setup_theme', 'express_setup' );

if ( ! isset( $content_width ) ) { $content_width = 640; }

function express_scripts() {
	global $wp_version;
	$version = wp_get_theme( wp_get_theme()->template )->get( 'Version' );

	if ( defined( 'WP_ENV' ) && 'development' === WP_ENV ) {
		$assets = array(
			'css' => '/assets/css/express.css',
			'js'  => '/assets/js/express.js',
		);
	} else {
		$assets = array(
			'css' => '/assets/css/express.min.css',
			'js'  => '/assets/js/express.min.js',
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  wp_enqueue_style( 'express-fonts', express_fonts_url(), array(), null );
  wp_enqueue_style( 'express-main', get_template_directory_uri() . $assets['css'], array(), $version );
  wp_enqueue_style( 'express-style', get_stylesheet_uri() );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'express-js', get_template_directory_uri() . $assets['js'], array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'express_scripts' );

function express_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'express' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<section class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'express_widgets_init' );

if ( ! function_exists( 'express_posted_on' ) ) :
function express_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'express' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);

	$categories_list = get_the_category_list( __( ', ', 'express' ) );
	if ( $categories_list ) {
		printf( __( '<span class="categories-links"> in %1$s</span>', 'express' ),
			$categories_list
		);
	}
}
endif;
