<?php

class whyhellothereCustomizer {

	public static function register ( $wp_customize ) {

		require_once('options-config.php');

	  // Build sections
		foreach ( $whyhellothere_sections as $whyhellothere_section) {
    	$wp_customize->add_section( $whyhellothere_section['id'], $whyhellothere_section['args'] );
		}

	  // Build settings
	  foreach ( $whyhellothere_settings as $whyhellothere_setting ) {

	  	if ( $whyhellothere_setting['add_args']['type'] == 'theme_mod' ) {

		  	$control_class = $whyhellothere_setting['control_class'];

				$wp_customize->add_setting( $whyhellothere_setting['id'], $whyhellothere_setting['add_args'] );      	      
		    $wp_customize->add_control( new $control_class( $wp_customize, 'whyhellothere_' . $whyhellothere_setting['id'], $whyhellothere_setting['control_args'] ) );
	 		} else {
	 			$wp_customize->add_setting( $whyhellothere_setting['id'], $whyhellothere_setting['add_args'] );
	 			$wp_customize->add_control( 'whyhellothere_' . $whyhellothere_setting['id'], $whyhellothere_setting['control_args'] );
	 		}
	  }
	  
	  // Make some stuff use live preview JS
	  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 * 
	 * Used by hook: 'wp_head'
	 */

	public static function header_output() {
		?>

		<!--Customizer CSS--> 
		<style type="text/css">
			<?php self::generate_css('.site-title, .right-sidebar .widget .heading, .entry-tags a:hover, .comment-list li .comment-content .comment-reply a:hover, input[type="submit"]:hover, #commentform input[type="submit"], #nav ul ul li a:hover, #footer', 'background-color', 'primary_color'); ?> 
			<?php self::generate_css('.right-sidebar .widget .heading:after', 'border-top-color', 'primary_color'); ?>
			<?php self::generate_css('.right-sidebar .widget ul li:hover', 'border-color', 'primary_color'); ?>
			<?php self::generate_css('.entry-category a, .entry-content a:hover, .more-link, .post-navigation a:hover, article:after, #postscript a:hover, .page-title:before, .archive-title:before', 'color', 'primary_color'); ?>
		</style> 
		<?php
	}	

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 * 
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo Optional. Whether to print directly to the page (default: true).
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since Here Ya Go 1.0.3
	 * 
	 */

	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'whyhellothereCustomizer' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'whyhellothereCustomizer' , 'header_output' ) );
