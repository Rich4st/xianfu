<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title           标题
 * @var string $desc            描述
 * @var string $bg_color        背景色
 * @var string $style           风格
 * @var string $thumbs_ratio    缩略图比例
 * @var string $cols            展示列数
 * @var boolean $extra_info     是否展示额外信息
 * @var boolean $is_pagination  是否开启分页
 * @var array $exclude          排除的分类
 *
 */
extract($args);


$query_args = array(
  'paged' => get_query_var('paged', 1),
  'ignore_sticky_posts' => false,
  'post_status' => 'publish',
  'category__not_in' => $exclude ?? [],
);

$PostData = new WP_Query($query_args);

$widget_config = [
  'thumbs_ratio' => $thumbs_ratio,
  'cols' => $cols,
  'extra_info' => $extra_info,
  'exclude' => $exclude,
  'is_pagination' => $is_pagination,
];

$pagination_config = [
  'style' => $style,
  'ul_id' => 'posts-wrapper-' . $id,
  'style_config' => json_encode($widget_config, JSON_HEX_TAG | JSON_HEX_APOS),
];


?>

<section class="dark:bg-dark py-8" style="background-color: <?php echo $bg_color; ?>;">
  <div class="ca-container">
    <?php if ($title || $desc) : ?>
      <div class="my-8 text-center text-gray-400">
        <?php if ($title) : ?>
          <h2 class="text-xl md:text-3xl font-bold text-gray-900 dark:text-gray-100">
            <?php echo $title ?? '最新文章'; ?>
          </h2>
        <?php endif; ?>
        <?php if ($desc) : ?>
          <p class="mt-2 text-gray-500 dark:text-gray-400">
            <?php echo $desc ?? ''; ?>
          </p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <ul id="<?php echo $pagination_config['ul_id']; ?>" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4      md:gap-8">
      <?php if ($PostData->have_posts()) :
        while ($PostData->have_posts()) : $PostData->the_post();
          get_template_part('template-parts/loop/' . $style, '', $widget_config);
        endwhile;
      else :
        get_template_part('template-parts/loop/item', 'none');
      endif; ?>
    </ul>

    <?php if ($widget_config['is_pagination']) : ?>
      <?php capalot_load_more($pagination_config); ?>
    <?php endif; ?>
  </div>
</section>
