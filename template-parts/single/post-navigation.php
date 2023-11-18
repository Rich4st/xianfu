<?php

$prev = get_previous_post();
$next = get_next_post();

?>

<div class="flex justify-between items-center">
  <?php if ($prev) : ?>
    <div style="flex: 1;">
      <span class="excerpt text-sm">上一篇</span>
      <a title="<?php echo $next->post_title; ?>" class="link group flex items-center" href="<?php echo get_permalink($prev->ID); ?>" class="flex items-center space-x-2">
        <i class="iconify text-xl group-hover:-translate-x-2 duration-300 ease-linear" data-icon="mdi:arrow-left"></i>
        <span><?php echo $prev->post_title; ?></span>
      </a>
    </div>
  <?php endif; ?>
  <?php if ($next) : ?>
    <div style="flex: 1;" class="text-right">
      <span class="excerpt text-sm">下一篇</span>
      <a title="<?php echo $next->post_title; ?>" class="link group flex items-center justify-end" href="<?php echo get_permalink($next->ID); ?>" class="flex items-center space-x-2">
        <span class=" line-clamp-1"><?php echo $next->post_title; ?></span>
        <i class="iconify text-xl group-hover:translate-x-2 duration-300 ease-linear" data-icon="mdi:arrow-right"></i>
      </a>
    </div>
  <?php endif; ?>
</div>
