<?php

/**
 * Custom page navigation template tag for archives, categories etc. 
 * Appears in index.php, archive.php, category.php, author.php
 */

if ( ! function_exists( 'whyhellothere_page_nav' ) ) {
	function whyhellothere_page_nav() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo '<div class="pages-navigation clearfix">';
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
		echo '</div>';
	}
}

/**
 * Custom post navigation template tag for single posts & pages
 * Appears in content.php
 */

if ( ! function_exists( 'whyhellothere_post_nav' ) ) {
	function whyhellothere_post_nav() {
	  ?>
	  <nav class="post-navigation clearfix"> 
	  	<span class="post-nav-link previous-post">
				<?php previous_post_link('%link', '<span class="previous-post-label">' . __( 'Previous Post', 'whyhellothere' ) . '</span><br />%title' ); ?>
			</span>
			<span class="post-nav-link next-post">
				<?php next_post_link('%link', '<span class="next-post-label">' . __( 'Next Post', 'whyhellothere' ) . '</span><br />%title' ); ?>
			</span>
		</nav>
		<?php
	}
}

/**
 * Custom post thumbnail template tag
 * Appears in content.php
 */

if ( ! function_exists( 'whyhellothere_post_thumbnail' ) ) {
	function whyhellothere_post_thumbnail() {

		global $post;
		$post_thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

		if ( post_password_required() || ! has_post_thumbnail() ) {
			if ( ! is_single() && ! is_page() ) {
				echo '<div class="place-holder"><i class="fa fa-camera"></i></div>';
			} else
			return;
		}

	  if ( ! is_singular() && has_post_thumbnail() ) {
	  	echo '<div class="entry-image-thumb">';
			echo '<a href="' . get_permalink() . '">';
			echo get_the_post_thumbnail($post->ID, 'post-image-thumb',  array('class' => 'responsive'));
			echo '</a>';
			echo '</div>';
		} else {
			echo '<div class="entry-image">';
			echo '';
			echo get_the_post_thumbnail($post->ID, 'post-image',  array('class' => 'responsive'));
			echo '';
			echo '</div>';
		}
	}
}

/**
 * Social Icons
 * Used in header.php, probably
 */

function whyhellothere_social_icon( $site ) {

	$options = get_option('whyhellothere_theme_options');

	if ( $options[ $site . '_url'] ) {
		$site_url = $options[ $site . '_url'];
	} else {
		$site_url = NULL;
	}

	if ( $site_url != NULL) {
		echo '<a href="' . esc_url( $site_url ) . '"><i class="fa fa-' . $site . '"></i></a>';
	}

}

