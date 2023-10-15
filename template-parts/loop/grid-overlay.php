<?php

$post_id = get_the_id();
?>

<li class="post-item cursor-pointer rounded-lg text-white overflow-hidden text-sm relative group">

  <?php if (is_sticky()) : ?>
    <p class="absolute top-1 left-1 px-2 text-center z-50 bg-gray-400 rounded-full bg-opacity-40">置顶</p>
  <?php endif; ?>

  <div class="lazy bg-no-repeat bg-cover overflow-hidden ratio <?php echo esc_attr($args['thumbs_ratio']); ?>" data-bg="<?php capalot_get_thumbnail_url(); ?>">
    <div class="overlay hidden group-hover:block bg-opacity-10 linear-bg">

      <a href="<?php the_permalink(); ?>" class="absolute top-0 bottom-0 left-0 right-0 z-40" style="display: block;"></a>

      <div class="absolute bottom-8 left-2 w-full pr-2 z-50">
        <?php if (in_array('category', $args['extra_info'])) : ?>
          <ul class="flex items-center space-x-1">
            <?php capalot_meta_category(2); ?>
          </ul>
        <?php endif; ?>
        <a class="font-bold line-clamp-1 text-base hover:text-gray-300 w-fit" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </div>
    </div>
  </div>
</li>
