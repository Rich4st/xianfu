<?php get_header();

if (is_active_sidebar('home-module')) {
  dynamic_sidebar('home-module');
} else {
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      the_title();
    }
  }
}

get_footer();
