<?php

// 获取当前文章的分类
$categories = get_the_category();

$related_posts = new WP_Query(
  array(
    'category__in' => wp_list_pluck($categories, 'term_id'),
    'post__not_in' => $args,
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1
  )
);

$config = [
  'thumbs_ratio' => 'ratio-16x9',
  'extra_info' => ['category', 'desc'],
  'exclude' => [],
  'is_pagination' => false,
];

?>

<section class="my-16 px-2 md:px-0">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-left">相关文章</h2>
    <ul class="grid grid-cols-1 gap-2 md:grid-cols-3 md:gap-8 mt-4 md:mt-8">
      <?php if ($related_posts->have_posts()) : ?>

        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
          <?php get_template_part('template-parts/loop/grid', '', $config); ?>
        <?php endwhile; ?>

      <?php else : ?>
        <li>暂无相关文章</li>
      <?php endif; ?>
    </ul>
  </div>
</section>
