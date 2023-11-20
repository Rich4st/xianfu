<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title   标题
 * @var string $exclude 要排除显示的分类
 *
 */
extract($args);

// 查询所有分类，及分类下的文章数量
$categories = get_categories(array(
  'exclude' => $exclude,
  'orderby' => 'count',
  'order' => 'DESC'
));

?>

<section class="my-8">
  <h3><?php echo $title; ?></h3>
  <ul class="space-y-2 mt-4">
    <?php foreach ($categories as $category) : ?>
      <li>
        <a class="link" href="<?php echo get_category_link($category->term_id); ?>" aria-label="<?php echo $category->name; ?>">
          <?php echo $category->name; ?>
        </a>
        <span class="text-gray-500 dark:text-gray-400 ml-1">
          (<?php echo $category->count; ?>)
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
