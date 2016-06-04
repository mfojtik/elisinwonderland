<?php 

  $options = get_option('whyhellothere_theme_options');

  $slider_query = new WP_Query( 
    array( 
      'post_type' => 'post', 
      'nopaging' => true,
      'tag' =>  $options['featured_tag'],
      'order' => $options['slide_ordering'],
    ) 
  ); 
?>

<?php if ( $slider_query->have_posts() ) : ?>
  <div id="slider" class="clearfix">
    <div class="flexslider">
      <ul class="slides">

      <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>

        <li>
          <div class="slider-image">
            <?php if ( has_post_thumbnail() ): ?>
              <?php echo get_the_post_thumbnail($post->ID, 'slider-image'); ?>
            <?php else: ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" />
            <?php endif; ?>
          </div>
          <div class="slider-caption">
            <h2 class="slider-title"><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h2>
            <span class="slider-excerpt"><?php the_excerpt(); ?></span>
          </div>
        </li>

      <?php endwhile; ?>

      <?php wp_reset_postdata(); ?>

      </ul>
    </div>
  </div>
<?php endif; ?>

