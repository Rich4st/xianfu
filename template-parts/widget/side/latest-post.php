<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title   标题
 * @var string $exclude 要排除显示的文章分类
 * @var string $total   显示的文章数量
 *
 */
extract($args);

$posts = get_posts([
  'numberposts' => $total,
  'category'    => $exclude,
]);

?>

<section class="my-12">
  <h3><?php echo $title; ?></h3>
  <ul class="space-y-2 mt-4">
    <?php foreach($posts as $post) : ?>
      <li>
        <a class="link" href="<?php echo get_permalink($post->ID); ?>" aria-label="<?php echo $post->post_title; ?>">
          <?php echo $post->post_title; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
