<?php 

/**
 * Setup the theme and define some custom template tags 
 * Functions are prefixed with 'whyhellothere'
 *
 * @package  Why Hell There
 * @since  Why Hello There 1.0
 */

// Set content width
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

// Theme setup
if ( ! function_exists( 'whyhellothere_theme_setup' ) ) {
	function whyhellothere_theme_setup() {
		
		// Make theme available for translation
		load_theme_textdomain( 'whyhellothere', get_template_directory_uri() . '/lang' );
		
		// Add support for post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add new image sizes
 		add_image_size( 'post-image', 1200, 800, true );
 		add_image_size( 'post-image-thumb', 210, 210, true );
 		add_image_size( 'slider-image', 1200, 600, true );

		// Add RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// Switch core search form, comment form and comment list to ouput valid HTML5
		add_theme_support( 'html5', 
			array(
				'search-form', 
				'comment-form', 
				'comment-list',
			) 
		);

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		// Register nav menus
		register_nav_menus( 
			array(
				'primary'   => __( 'Primary', 'whyhellothere' ),
			) 
		);		
	}
}
add_action( 'after_setup_theme', 'whyhellothere_theme_setup' );

// Register Sidebars
if ( ! function_exists( 'whyhellothere_register_sidebars' ) ) {
	function whyhellothere_register_sidebars() {
		register_sidebar(array(
			'name' => 'Right Sidebar',
			'id' => 'right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="heading">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Postscript',
			'id' => 'postscript-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="heading">',
			'after_title' => '</h3>',
		));
	}
}
add_action( 'widgets_init', 'whyhellothere_register_sidebars' );

// Enqueue scripts & styles
if ( ! function_exists( 'whyhellothere_scripts' ) ) {
	function whyhellothere_scripts(){

		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array( 'jquery' ), '2.7.1', false );
		wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );
		wp_register_script( 'fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );
		wp_register_script( 'doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'baseline', get_template_directory_uri() . '/assets/js/baseline.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'flexslider', get_template_directory_uri() . '/flexslider/jquery.flexslider.js', array( 'jquery' ), '2.2.2', true );
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.5', true );
		wp_register_script( 'whyhellothere', get_template_directory_uri() . '/assets/js/whyhellothere.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script( 'modernizr');
		wp_enqueue_script( 'prettyPhoto');
		wp_enqueue_script( 'fitvids');
		wp_enqueue_script( 'doubletaptogo');
		wp_enqueue_script( 'baseline');
	 	wp_enqueue_script( 'flexslider');
		wp_enqueue_script( 'imagesloaded');
		wp_enqueue_script( 'whyhellothere');

		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	}
}
add_action( 'wp_enqueue_scripts', 'whyhellothere_scripts' );

// Enqueue conditional IE styles for fixed width layout in IE7/IE8

if ( ! function_exists( 'whyhellothere_ie_styles' ) ) {
	function whyhellothere_ie_styles() {
	global $is_IE;
		if ( $is_IE ) {
	  	echo '<!--[if lt IE 9]>';
		  echo '<link rel="stylesheet" href="'. get_template_directory_uri() . '/assets/css/ie.css" type="text/css" media="all" />';
		  echo '<![endif]-->';
		}
	}
}
add_action( 'wp_head', 'whyhellothere_ie_styles' );

// Enqueue Google fonts
 
if ( ! function_exists( 'whyhellothere_google_fonts' ) ) {
	function whyhellothere_google_fonts() {
		if ( !is_admin() ) {
			wp_register_style( 'googleFont', '//fonts.googleapis.com/css?family=Voltaire|Bitter:400,700|Fjalla+One' );
			wp_enqueue_style( 'googleFont' );
		}
	}
}
add_action('wp_enqueue_scripts', 'whyhellothere_google_fonts');

// Enqueue Font Awesome

if ( ! function_exists( 'whyhellothere_font_awesome' ) ) {
	function whyhellothere_font_awesome() {
		if ( ! is_admin() ) {
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', null, '4.0.3' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'whyhellothere_font_awesome', 99 );

/**
 * Improve the title element
 * @param  string $title Default title
 * @param  string $sep Seperator 
 * @return The filtered title
 */

if ( ! function_exists( 'whyhellothere_wp_title' ) ) {
	function whyhellothere_wp_title( $title, $sep ) {
		global $paged, $page;
		$sep = " | ";

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'whyhellothere' ), max( $paged, $page ) );
		}

		return $title;
	}
}
add_filter( 'wp_title', 'whyhellothere_wp_title', 10, 2);

// Restructure Comments 

if ( ! function_exists( 'whyhellothere_comment' ) ) {
	function whyhellothere_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
	
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php endif; ?>
			
			<div class="comment-avatar pull-left">
				<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			
			<div class="comment-content">
				<div class="comment-meta commentmetadata">
					<a class="comment-author" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a>
					<a class="comment-date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"> 
					<?php printf( __( '%1$s at %2$s', 'whyhellothere' ), get_comment_date(),  get_comment_time()) ?></a><span class="comment-edit"><?php edit_comment_link( __('[Edit]', 'whyhellothere'),'  ','' ); ?></span>
					<div class="comment-reply pull-right"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>  
				</div>
		
				<?php comment_text() ?> 
				
				<?php if ( 'div' != $args['style'] ) : ?>
					
				<?php if ($comment->comment_approved == '0') : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'whyhellothere' ) ?></em>
						<br />
				<?php endif; ?> 
			</div>
				
		</div>
		<?php endif; 
	}
}

// Body Classes 
 
if ( ! function_exists( 'whyhellothere_body_classes' ) ) {
	function whyhellothere_body_classes($classes) {
		if ( ! is_active_sidebar( 'right-sidebar' ) || is_page_template( 'page-templates/full-width.php' ) ) {
			$classes[] = 'full-width';
		} 

		if ( is_active_sidebar( 'postscript-sidebar' ) ) {
			$classes[] = 'postscript-sidebar';
		} 

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}	

		return $classes;
	}
}
add_filter('body_class', 'whyhellothere_body_classes');

// Add custom template tags
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/theme-options.php';