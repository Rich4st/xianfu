<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * $title   标题
 * $exclude 要排除显示的分类
 */
extract($args);

$tags = get_terms([
  'taxonomy' => 'post_tag',
  'hide_empty' => true,
  'orderby' => 'count',
  'order' => 'DESC',
  'exclude' => $exclude
]);

?>

<section>
  <h3><?php echo $title; ?></h3>
  <ul class="flex flex-wrap mt-4">
    <?php foreach ($tags as $tag) : ?>
      <li class="mr-2 mb-2 bg-primary text-white rounded-full hover:bg-primary-hover">
        <a class="block py-1.5 px-5" href="<?php echo get_tag_link($tag->term_id); ?>" aria-label="<?php echo $tag->name; ?>">
          <?php echo $tag->name; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
