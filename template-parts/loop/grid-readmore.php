<?php

$post_id = get_the_id();

/**
 * @var string $thumbs_ratio 缩略图比例
 * @var array $extra_info 额外信息
 *    - category 分类
 *    - desc 描述
 *    - footer 底部信息
 */
extract($args);

if (empty($thumbs_ratio)) {
  $thumbs_ratio = 'ratio-16x9';
}

if (empty($extra_info)) {
  $extra_info = array(
    'desc'
  );
}

?>

<li class="rounded-md overflow-hidden">
  <div class="ratio <?php echo esc_attr($thumbs_ratio); ?>">
    <a data-bg="<?php capalot_get_thumbnail_url(); ?>" class="lazy bg-no-repeat bg-cover bg-center" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    </a>
  </div>
  <div class="py-4 text-xs space-y-2">

    <?php if (in_array('category', $extra_info)) :
      $categories = get_the_category();
    ?>
      <ul class="flex items-center space-x-2 mb-4">
        <?php foreach ($categories as $key => $cat) : ?>
          <li>
            <a class="p-2 text-white bg-primary hover:bg-primary-hover" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" title="<?php echo esc_attr($cat->name); ?>">
              <?php echo esc_html($cat->name); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <a class="block text-base w-fit font-bold text-gray-600 hover:text-black dark:text-gray-100 dark:hover:text-gray-300" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <h4><?php the_title(); ?></h4>
    </a>

    <?php if (in_array('desc', $extra_info)) : ?>
      <p class="excerpt text-sm line-clamp-3" title="<?php capalot_post_excerpt(100); ?>">
        <?php capalot_post_excerpt(100); ?>
      </p>
    <?php endif; ?>

    <?php if (in_array('footer', $extra_info)) : ?>
      <ul class="flex items-center space-x-2 text-gray-400">
        <li>
          <?php capalot_postupdate_time(); ?>
        </li>
        <li class="flex items-center">
          <i class="iconify mr-1 text-sm" data-icon="ph:eye-fill"></i>
          <span>99+</span>
        </li>
      </ul>
    <?php endif; ?>

    <a class="link text-base flex items-center" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <span>阅读全文</span>
      <i class="iconify" data-icon="ep:top-right"></i>
    </a>

    <div class="space-x-2 excerpt">
      <span>
        <?php echo get_the_date('M j, Y'); ?>
      </span>
      <span>
        <?php echo get_comments_number(); ?>
        评论
      </span>
    </div>

  </div>
</li>
