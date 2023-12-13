<?php

/**
 * Template Name: 认证服务
 */

get_header();


$query_args = array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'paged'           => $page,
  'posts_per_page'  => $limit,
  'orderby'         => 'date',
  'order'           => 'DESC',
  'category_name'   => 'certify-service',
);

$posts = new WP_Query($query_args);

?>

<section>
  <div class="ca-container my-8 ca-page-flex">

    <div class="w-full">
      <h2>认证服务</h2>

      <?php if ($posts->have_posts()) : ?>
        <ul class="grid grid-cols-4 gap-4 mt-8">
          <?php
          while ($posts->have_posts()) : $posts->the_post(); ?>
            <?php get_template_part('template-parts/loop/grid-readmore') ?>
          <?php endwhile; ?>
        </ul>
      <?php
        wp_reset_postdata();
        capalot_pagination($page, $posts->max_num_pages);
      else :
        get_template_part('template-parts/loop/item-none');
      endif;
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
