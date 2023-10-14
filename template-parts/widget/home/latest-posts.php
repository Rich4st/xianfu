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

$item_config = get_posts_style_config();

?>

<section class="dark:bg-dark py-8">
  <?php
  $section_title = $args['title'] ?? '';
  $section_desc = $args['desc'] ?? '';

  var_dump($args);
  ?>
  <div class="flex-col-center max-w-6xl p-8 mx-auto text-center text-sm text-gray-400">
    <h2 class="text-xl md:text-3xl font-bold leading-tight text-gray-900 dark:text-gray-100">
      <?php echo $section_title; ?>
    </h2>
    <p class="mt-2 md:text-lg text-gray-500 dark:text-gray-400">
      <?php echo $section_desc; ?>
    </p>
  </div>
  <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8 px-2 md:px-10">
    <?php if ($PostData->have_posts()) :
      while ($PostData->have_posts()) : $PostData->the_post();
        get_template_part('template-parts/loop/' . $args['style'], '', $item_config);
      endwhile;
    else :
    get_template_part('template-parts/loop/item', 'none');
    endif; ?>
  </ul>
</section>
