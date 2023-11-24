<?php

/**
 * $title       标题
 * $is_typed    是否打字效果
 * $desc        描述
 * $bg_type     背景类型
 *    - img     图片
 *    - video   视频
 *    - waves   动态方块
 *    - clouds  动态天空
 *    - net     动态线条
 *    - halo    动态流光
 * $bg_overlay  背景遮罩
 * $bg_img      背景图片
 * $bg_video    背景视频
 *
 */
extract($args);

?>

<section class="relative">
  <?php if (!empty($bg_overlay)) : ?>
    <div class="absolute inset-0 bg-black bg-opacity-50 z-40"></div>
  <?php endif; ?>

  <?php if (in_array($bg_type, ['img', 'video'])) : ?>
    <div style="height: calc(75vh - 80px);">
      <?php if ($bg_type == 'video') : ?>
        <video autoplay muted loop class="h-full w-full object-cover">
          <source src="<?php echo $bg_video; ?>" type="video/mp4">
        </video>
      <?php else : ?>
        <img data-src="<?php echo $bg_img; ?>" class="lazy h-full w-full object-cover" alt="">
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="z-50 text-white absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
    <?php if (!empty($is_typed) && $is_typed === '1') {
      $typed = 'typed-text';
    }
    ?>
    <p data-strings="<?php echo $title; ?>" class="<?php echo $typed; ?> inline-block w-fit text-3xl md:text-4xl xl:text-5xl">
      <?php if($typed !== 'typed-text') {
        echo $title;
      } ?>
    </p>
    <p>
      <?php echo $desc; ?>
    </p>
  </div>
</section>
