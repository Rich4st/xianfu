<?php

if (empty($args))
  exit;


$query_args = array(
  'paged' => get_query_var('paged', 1),
  'ignore_sticky_posts' => false,
  'post_status' => 'publish',
  'category__not_in' => $args['exclude'] ?? [],
);

$PostData = new WP_Query($query_args);

$widget_config = [
  'thumbs_ratio' => $args['thumbs_ratio'],
  'cols' => $args['cols'],
  'extra_info' => $args['extra_info'],
  'exclude' => $args['exclude'],
  'is_pagination' => $args['is_pagination'],
];

$pagination_config = [
  'style' => $args['style'],
  'ul_id' => 'posts-wrapper-' . $args['id'],
  'style_config' => json_encode($widget_config, JSON_HEX_TAG | JSON_HEX_APOS),
];


?>

<section class="dark:bg-dark xf-container py-8">
  <?php if ($args['title'] || $args['desc']) : ?>
    <div class="my-8 text-center text-gray-400">
      <?php if ($args['title']) : ?>
        <h2 class="text-xl md:text-3xl font-bold text-gray-900 dark:text-gray-100">
          <?php echo $args['title'] ?? '最新文章'; ?>
        </h2>
      <?php endif; ?>
      <?php if ($args['desc']) : ?>
        <p class="mt-2 text-gray-500 dark:text-gray-400">
          <?php echo $args['desc'] ?? ''; ?>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <ul id="<?php echo $pagination_config['ul_id']; ?>" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4      md:gap-8">
    <?php if ($PostData->have_posts()) :
      while ($PostData->have_posts()) : $PostData->the_post();
        get_template_part('template-parts/loop/' . $args['style'], '', $widget_config);
      endwhile;
    else :
      get_template_part('template-parts/loop/item', 'none');
    endif; ?>
  </ul>

  <?php if ($widget_config['is_pagination']) : ?>
    <?php capalot_load_more($pagination_config); ?>
  <?php endif; ?>
</section>
