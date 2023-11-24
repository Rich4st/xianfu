<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title           标题
 * @var string $desc            描述
 * @var string $category        要展示的分类
 *
 */
extract($args);

$posts = get_posts(array(
  'numberposts' => 4,
  'category' => $category,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_status' => 'publish',
));

?>

<?php if (!empty($posts)) : ?>
  <section class="ca-container">
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

    <ul>
      <?php
      $first_post = array_shift($posts);
      ?>
      <?php get_template_part('template-parts/loop/grid-readmore', '', [
        'thumbs_ratio' => 'ratio-3x2',
        'extra_info' => array(
          'category',
          'desc'
        ),
        'direction' => 'row',
      ]) ?>
    </ul>
    <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
      <?php foreach ($posts as $key => $post) : ?>
        <?php get_template_part('template-parts/loop/grid-readmore', '', [
          'thumbs_ratio' => 'ratio-1x1',
          'extra_info' => array(
            'category',
            'desc'
          ),
          'direction' => 'col',
        ]) ?>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>
