<?php get_header(); ?>

<div id="main-content" class="main-content">
	<div class="main-content-inner">

    <?php 
	    
	    $options = get_option('whyhellothere_theme_options');
	   	
	   	if ( $options['front_slider_enabled'] == 1 && is_front_page() ): 
	      get_template_part( 'front-slider' );
	    endif; 
    ?>	

		<?php if ( have_posts() ) : 

			while ( have_posts() ) : the_post(); 
	  
	  		get_template_part('content', get_post_format()); 

	  		if ( comments_open() ) comments_template(); 

	  	endwhile; else: 
		  	_e('No posts were found. Sorry!', 'whyhellothere'); 
		 	endif; 

		 	whyhellothere_page_nav(); ?>
	</div>
</div><!-- #main-content" -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
