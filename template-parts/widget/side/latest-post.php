<?php

/**
 * @var string $title   标题
 * @var string $total   显示的文章数量
 * @var string $exclude 要排除显示的文章分类
 * @var string include  要显示的文章分类      - get_template_parts时使用
 *
 */
extract($args);

if(empty($title)) {
  $title = '近期文章';
}

if(empty($total)) {
  $total = 10;
}

$posts = new WP_Query(array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'posts_per_page'  => $total,
  'orderby'         => 'date',
  'order'           => 'DESC',
  'category__not_in' => $exclude,
  'category__in'    => $include,
));

?>

<section class="my-12">
  <h3><?php echo $title; ?></h3>
  <ul class="space-y-2 mt-4">
    <?php if ($posts->have_posts()):
      while ($posts->have_posts()) : $posts->the_post(); ?>
        <li class="flex items-center justify-between">
          <a class="link w-full line-clamp-2" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
          </a>
          <p class="text-gray-400 w-16 text-xs">
            <?php capalot_postupdate_time(); ?>
          </p>
        </li>
      <?php endwhile; ?>
    <?php else:
      get_template_part('template-parts/loop/item-none');
    endif; ?>
  </ul>
</section>
