<?php

/**
 * 网站静态资源加载
 */
function load_assets()
{

  // jquery
  wp_deregister_script('jquery');
  wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '3.6.0', false);

  // tailwind
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0.0', 'all');
  // app
  wp_enqueue_style('app', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0.0', 'all');
  wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', array(), '1.0.0', true);
  // swiper
  wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '10.1.0');
  wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '10.1.0', true);
  // iconify
  wp_enqueue_script('icon', get_template_directory_uri() . '/assets/js/iconify.min.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'load_assets');
