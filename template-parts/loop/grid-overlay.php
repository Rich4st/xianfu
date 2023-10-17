<?php

$post_id = get_the_id();
?>

<li class="post-item cursor-pointer rounded-lg text-white overflow-hidden text-xs relative group">

  <?php if (is_sticky()) : ?>
    <p class="absolute top-1 left-1 px-2 text-center z-50 bg-gray-400 rounded-full bg-opacity-40">置顶</p>
  <?php endif; ?>

  <div class="lazy z-40 bg-no-repeat bg-cover overflow-hidden ratio <?php echo esc_attr($args['thumbs_ratio']); ?>" data-bg="<?php capalot_get_thumbnail_url(); ?>">
    <div class="overlay bg-opacity-10 linear-bg">

      <a href="<?php the_permalink(); ?>" class="absolute top-0 bottom-0 left-0 right-0 z-40" style="display: block;"></a>

      <div class="absolute bottom-7 left-2 w-full pr-2 z-50 space-y-1">
        <?php if (in_array('category', $args['extra_info'])) : ?>
          <ul class="flex items-center space-x-2">
            <?php capalot_post_category(2); ?>
          </ul>
        <?php endif; ?>

        <a class="font-bold line-clamp-1 text-base hover:text-gray-300 w-fit" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

        <p class="line-clamp-1" title="<?php capalot_post_excerpt(); ?>"><?php capalot_post_excerpt(); ?></p>
      </div>
    </div>
  </div>

  <?php if (in_array('footer', $args['extra_info'])) : ?>
    <ul class="z-50 absolute bottom-2 left-2 flex items-center space-x-2">
      <li>
        <?php capalot_postupdate_time(); ?>
      </li>
      <li class="flex items-center">
        <i class="iconify mr-1 text-sm" data-icon="ph:eye-fill"></i>
        <span>99+</span>
      </li>
    </ul>
  <?php endif; ?>
</li>
