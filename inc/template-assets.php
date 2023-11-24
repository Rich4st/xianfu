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
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/dist/vite.entry.css', array(), '1.0.0', 'all');
  // highlight.js only single
  if (is_singular()) {
    wp_enqueue_style('github-dark', get_template_directory_uri() . '/assets/css/highlight/github-dark.min.css', array(), '11.9.0');
    wp_enqueue_script('highlight-js', get_template_directory_uri() . '/assets/js/highlight/highlight.min.js', array(), '11.9.0', true);
  }
  // swiper
  wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '10.1.0');
  wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '10.1.0', true);
  // iconify
  wp_enqueue_script('icon', get_template_directory_uri() . '/assets/js/iconify.min.js', array(), '1.0.0', true);
  // lazyload
  wp_enqueue_script('lazyload', get_template_directory_uri() . '/assets/js/lazyload.min.js', array(), '17.8.0', true);
  // popper.js
  wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper/popper.min.js', array(), '2.11.8', true);
  wp_enqueue_script('tippy', get_template_directory_uri() . '/assets/js/popper/tippy-bundle.umd.min.js', array(), '6.3.7', true);
  // sweetalert2
  wp_enqueue_script('sweetalert2', get_template_directory_uri() . '/assets/js/sweetalert2.min.js', array(), '11.10.0', true);
  // typed.js
  wp_enqueue_script('typed', get_template_directory_uri() . '/assets/js/typed.umd.js', array(), '2.1.0', true);

  // app
  wp_enqueue_style('app', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0.0', 'all');
  wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', array(), '1.0.0', true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }



  // 全局参数
  $global_params = [
    'ajax_url'    => esc_url(admin_url('admin-ajax.php')),
    'ajax_nonce'  => wp_create_nonce("capalot_ajax"),
  ];
  if (is_singular()) {
    $global_params['post_id'] = get_the_ID();
  }
  wp_localize_script('app', 'g_p', $global_params);
}
add_action('wp_enqueue_scripts', 'load_assets');
