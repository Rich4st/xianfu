<?php

if (empty($args)) {
  return;
}

$config = [
  'lazy' => true,
  'navigation' => [
    'nextEl' => '.swiper-button-next',
    'prevEl' => '.swiper-button-prev'
  ],
  'slidesPerView' => $args['slidesPerView'], // 幻灯片列数
  'spaceBetween' => $args['spaceBetween'], // 幻灯片列间距
  'pagination' => [
    'el' => '.swiper-pagination',
    'clickable' => true
  ],
];

foreach ($args['config'] as $key) {
  $config[$key] = true;
}

?>

<section>
  <div class="swiper mySwiper mx-auto" data-config='<?php echo json_encode($config); ?>'>
    <div class="swiper-wrapper ">

      <?php
      if(empty($args['data'])) return;
      foreach ($args['data'] as $item) : ?>

        <div class="swiper-slide text-white ">
          <div class="relative h-[20rem] md:h-[36rem]">
            <img src="<?php echo $item['_img']; ?>" class="w-full h-full object-cover">
            <?php echo $args['container']; ?>
            <div class="absolute bottom-1/2 space-y-2 text-center w-full translate-y-1/2 px-10">
              <?php echo $item['_desc']; ?>
            </div>
            <?php if (!empty($item['_href'])) : ?>
              <a target="<?php echo $item['_target']; ?>" class="u-permalink " href="<?php echo $item['_href']; ?>"></a>
            <?php endif; ?>
          </div>
        </div>

      <?php endforeach; ?>

    </div>
    <!-- 圆点按钮 -->
    <?php if($config['dots'] && !$config['nav']): ?>
      <div class="swiper-pagination"></div>
    <?php endif; ?>

    <!-- 切换按钮 -->
    <?php if ($config['nav']) : ?>
      <div class="swiper-button-next after:text-white"></div>
      <div class="swiper-button-prev after:text-white"></div>
    <?php endif; ?>
  </div>
</section>
