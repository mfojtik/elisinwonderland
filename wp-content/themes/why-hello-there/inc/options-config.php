<?php 

/**
 * Sections
 */

$whyhellothere_sections = array();

$whyhellothere_sections[] = array(
  'id' => 'front_slider',
  'args' => array (
    'title' => 'Front Page Slider',
    'priority' => 45,
    'description' => 'Change the slider settings'
  )
);

$whyhellothere_sections[] = array(
  'id' => 'social_icons',
  'args' => array (
    'title' => 'Social Icons',
    'priority' => 50,
    'description' => 'Social URLs'
  )
);

/**
 * Settings
 */

$whyhellothere_settings = array();

$whyhellothere_settings[] = array(
  'id' => 'primary_color',
  'add_args' => array (
    'default' => '#D12424',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
  ),
  'control_args' => array(
    'label' => __( 'Link Color', 'whyhellothere' ),
    'section' => 'colors',
    'settings' => 'primary_color',
    'priority' => 10
  ),
  'control_class' => 'WP_Customize_Color_Control'
);

// Featured Slider Settings

$whyhellothere_settings[] = array(
  'id' => 'whyhellothere_theme_options[front_slider_enabled]',
  'add_args' => array (
    'default' => true,
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ),
  'control_args' => array(
    'label'    => __('Enable Front Page Slider', 'whyhellothere'),
    'section'  => 'front_slider',
    'settings' => 'whyhellothere_theme_options[front_slider_enabled]',
    'type'     => 'checkbox',
  )
);

$whyhellothere_settings[] = array(
  'id' => 'whyhellothere_theme_options[featured_tag]',
  'add_args' => array (
    'default' => 'featured',
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ),
  'control_args' => array(
    'label'      => __('Tag for featuring posts on the slider:', 'whyhellothere'),
    'section'    => 'front_slider',
    'settings'   => 'whyhellothere_theme_options[featured_tag]'
  )
);

$whyhellothere_settings[] = array(
  'id' => 'whyhellothere_theme_options[slide_ordering]',
  'add_args' => array (
    'default' => 'DSC',
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ),
  'control_args' => array(
    'settings' => 'whyhellothere_theme_options[slide_ordering]',
    'label'   => 'ASC or DSC:',
    'section' => 'front_slider',
    'type'    => 'select',
    'choices'    => array(
        'ASC' => 'ASC',
        'DSC' => 'DSC',
    ),
  )
);

// Social Icons

$whyhellothere_settings[] = array(
  'id' => 'whyhellothere_theme_options[facebook_url]',
  'add_args' => array (
    'default' => '',
    'capability' => 'edit_theme_options',
    'type' => 'option',
    'sanitize_callback' => 'esc_url_raw'
  ),
  'control_args' => array(
    'label'      => __('Facebook page URL:', 'whyhellothere'),
    'section'    => 'social_icons',
    'settings'   => 'whyhellothere_theme_options[facebook_url]'
  )
);

$whyhellothere_settings[] = array(
  'id' => 'whyhellothere_theme_options[twitter_url]',
  'add_args' => array (
    'default' => '',
    'capability' => 'edit_theme_options',
    'type' => 'option',
    'sanitize_callback' => 'esc_url_raw'
  ),
  'control_args' => array(
    'label'      => __('Twitter URL:', 'whyhellothere'),
    'section'    => 'social_icons',
    'settings'   => 'whyhellothere_theme_options[twitter_url]'
  )
);