<?php

$default = [
  'type' => 'grid',
  'media_class' => 'ratio-3x2',
  'media_size_type' => 'bg-cover',
  'media_fit_type' => 'bg-center',
  'is_vip_icon' => true,
  'is_entry_cat' => true,
  'is_entry_desc' => true,
  'is_entry_meta' => true,
];

$args = wp_parse_args($args, $default);

$post_id = get_the_id();

?>

<li class="rounded-md border overflow-hidden dark:bg-dark-card dark:border-gray-700 hover:-translate-y-1 duration-300
  hover:shadow-xl">
  <div class="ratio <?php echo esc_attr($args['media_class']); ?>">
    <a data-bg="<?php echo capalot_get_thumbnail_url(); ?>" class="lazy <?php echo esc_attr($args['media_size_type']); ?>
        <?php echo esc_attr($args['media_fit_type']); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    </a>
  </div>
  <div class="px-4 py-2 text-sm space-y-1">
    <?php if ($args['is_entry_cat']) : ?>
      <ul class="flex items-center space-x-2">
        <?php capalot_meta_category(2); ?>
      </ul>
    <?php endif; ?>
    <a class="block w-fit font-bold text-gray-700 dark:text-gray-100 dark:hover:text-gray-300 hover:underline text-lg" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?></a>

    <?php if ($args['is_entry_desc']) : ?>
      <p class=" text-gray-400 line-clamp-1" title="<?php capalot_get_post_excerpt(40); ?>">
        <?php capalot_get_post_excerpt(40); ?>
      </p>
    <?php endif; ?>
  </div>
</li>
