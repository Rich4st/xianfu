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
  'breakpoints' => [
    320 => [
      'slidesPerView' => 1,
    ],
    768 => [
      'slidesPerView' => 2,
    ],
    1024 => [
      'slidesPerView' => 4,
      'spaceBetween'  => 40
    ]
  ],
];

?>

<section class="xf-container">
  <?php if ($args['title'] || $args['desc']) : ?>
    <div class="my-8 text-center text-gray-400">
      <?php if ($args['title']) : ?>
        <h2>
          <?php echo $args['title'] ?? '最新文章'; ?>
        </h2>
      <?php endif; ?>
      <?php if ($args['desc']) : ?>
        <p class="mt-2 text-gray-500 dark:text-gray-400">
          <?php echo $args['desc'] ?? ''; ?>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="swiper mySwiper attribute-slider mx-auto" data-config='<?php echo json_encode($config); ?>'>
    <div class="swiper-wrapper ">

      <?php
      if (empty($args['data'])) return;
      foreach ($args['data'] as $item) : ?>

        <div class="swiper-slide">
          <div class="relative">
            <img src="<?php echo $item['_attribute'][0]['_img']; ?>" class="w-full h-2/3 object-cover" alt="<?php echo $item['_attribute'][0]['_title'] ?>">

            <p class="text-center dark:text-gray-100 my-3 line-clamp-1"><?php echo $args['desc']; ?></p>

            <?php if ($item['_attribute']) : ?>
              <div class="flex items-center justify-center mt-2 space-x-2">
                <?php foreach ($item['_attribute'] as $attr) : ?>
                  <button aria-label="切换属性" data-content="<?php echo $attr['_title']; ?>" id="swiper-attribute" data-attr="<?php echo $attr['_img']; ?>" type="button" class="popper-button btn"></button>
                <?php endforeach; ?>
              </div>
            <? endif; ?>

          </div>
        </div>

      <?php endforeach; ?>
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</section>
