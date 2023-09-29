<?php

/**
 * 网站静态资源加载
 */
function load_assets() {

  // tailwind
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0.0', 'all');

}
add_action('wp_enqueue_scripts', 'load_assets');
