<?php

/**
 * @var string $title             标题
 * @var string $total             显示的文章数量
 * @var string $exclude           要排除显示的文章分类
 * @var string $only_current_cat  仅显示当前分类文章
 *
 */
extract($args);

if($only_current_cat) {
  $include = array(get_queried_object()->term_id);
}

$posts = new WP_Query(array(
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'posts_per_page'   => $total,
  'orderby'          => 'date',
  'order'            => 'DESC',
  'category__not_in' => $exclude,
  'category__in'     => $include,
));

?>

<section class="my-12">
  <h2 class="font-bold"><?php echo $title; ?></h2>
  <ul class="space-y-2 mt-4">
    <?php if ($posts->have_posts()):
      while ($posts->have_posts()) : $posts->the_post(); ?>
        <li class="flex items-center justify-between py-4 border-b">
          <a class="w-full line-clamp-2 text-lg href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
          </a>
        </li>
      <?php endwhile; ?>
    <?php else:
      get_template_part('template-parts/loop/item-none');
    endif; ?>
  </ul>
</section>
