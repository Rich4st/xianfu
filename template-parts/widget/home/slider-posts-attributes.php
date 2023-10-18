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
    ]
  ],
];

?>

<section>
  <div class="swiper mySwiper mx-auto" data-config='<?php echo json_encode($config); ?>'>
    <div class="swiper-wrapper ">

      <?php
      if (empty($args['data'])) return;
      foreach ($args['data'] as $item) : ?>

        <div class="swiper-slide text-white">
          <div class="relative h-[20rem] md:h-[36rem]">
            <img src="<?php echo $item['_img']; ?>" class="w-full h-2/3 object-cover">

            <?php if ($item['_attribute']) : ?>
              <ul class="flex items-center justify-center mt-2 space-x-2">
                <?php foreach ($item['_attribute'] as $attr) : ?>
                  <li id="swiper-attribute" data-attr="<?php echo $attr['_img']; ?>" style="background-color: <?php echo $attr['_color']; ?>" class="w-4 h-4 rounded-full">
                  </li>
                <?php endforeach; ?>
              </ul>
            <? endif; ?>

          </div>
        </div>

      <?php endforeach; ?>

    </div>

    <div class="swiper-button-next after:text-white"></div>
    <div class="swiper-button-prev after:text-white"></div>
  </div>
</section>
