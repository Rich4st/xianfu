<?php

$post_id = get_the_id();

?>

<li class="rounded-md border overflow-hidden dark:bg-dark-card dark:border-gray-700 hover:-translate-y-1 duration-300
  hover:shadow-xl">
  <div class="ratio <?php echo esc_attr($args['thumbs_ratio']); ?>">
    <a data-bg="<?php capalot_get_thumbnail_url(); ?>" class="lazy bg-no-repeat bg-cover" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    </a>
  </div>
  <div class="py-4 px-3 text-xs space-y-1">
    <?php if (in_array('category', $args['extra_info'])) : ?>
      <ul class="flex items-center space-x-2">
        <?php capalot_post_category(2); ?>
      </ul>
    <?php endif; ?>
    <a class="block text-base w-fit font-bold text-gray-600 hover:text-black dark:text-gray-100 dark:hover:text-gray-300 hover:underline" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?></a>

    <?php if (in_array('desc', $args['extra_info'])) : ?>
      <p class="text-gray-400 line-clamp-1" title="<?php capalot_post_excerpt(40); ?>">
        <?php capalot_post_excerpt(40); ?>
      </p>
    <?php endif; ?>

    <?php if (in_array('footer', $args['extra_info'])) : ?>
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

  </div>
</li>
