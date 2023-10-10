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

<?php if ($args['type'] === 'grid') : ?>
  <li class="rounded-md border overflow-hidden">
    <div class="ratio <?php echo esc_attr($args['media_class']); ?>">
      <a style="background-image: url(<?php echo capalot_get_thumbnail_url(); ?>);" class="<?php echo esc_attr($args['media_size_type']); ?>
        <?php echo esc_attr($args['media_fit_type']); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-bg="<?php echo capalot_get_thumbnail_url(); ?>">
      </a>
    </div>
    <div class="px-4">
      <?php if ($args['is_entry_cat']) : ?>
        <div class="my-1 line-clamp-1 flex items-center">
          <i class="iconify" data-icon='ri:price-tag-3-line'></i><?php capalot_meta_category(2); ?>
        </div>
      <?php endif; ?>
      <h2 class="font-bold text-gray-700 hover:underline">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h2>

      <?php if ($args['is_entry_desc']) : ?>
        <div class=" text-gray-400 text-[12px] min-h-[1.25rem] line-clamp-1 my-1" title="<?php echo capalot_get_post_excerpt(40); ?>">
          <?php capalot_get_post_excerpt(40); ?>
        </div>
      <?php endif; ?>
    </div>
  </li>
<?php endif; ?>
