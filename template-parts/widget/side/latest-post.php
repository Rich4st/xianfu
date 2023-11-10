<?php

/**
 * @var string $title   标题
 * @var string $exclude 要排除显示的文章分类
 * @var string $total   显示的文章数量
 *
 */
extract($args);

if(empty($title)) {
  $title = '近期文章';
}

$posts = get_posts([
  'numberposts' => $total ?? 6,
  'category__not_in' => $exclude,
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
