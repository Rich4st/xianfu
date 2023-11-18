<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title           标题
 * @var string $desc            描述
 * @var array $config           幻灯片配置
 *     - @var bool $autoplay    是否开启自动播放
 *     - @var bool $loop        是否开启循环
 *     - @var bool $dots        是否开启圆点按钮
 *     - @var bool $nav         是否开启左右按钮
 * @var string $slidesPerView   幻灯片数量
 * @var string $spaceBetween    幻灯片间距
 * @var array $data             客户反馈数据
 *     - @var string $_img     客户头像
 *     - @var string $_from    客户来源
 *     - @var string $_content 客户反馈内容
 *     - @var string $_name    客户姓名
 *     - @var string $_job     客户职位
 */
extract($args);

$swiper_config = [
  'lazy' => true,
  'pagination' => [
    'el' => '.swiper-customer-fb-pagination',
    'clickable' => true
  ],
  'navigation' => [
    'prevEl' => '.swiper-customer-fb-prev',
    'nextEl' => '.swiper-customer-fb-next',
  ],
  'breakpoints' => [
    320 => [
      'slidesPerView' => 1,
    ],
    640 => [
      'slidesPerView' => 2,
      'spaceBetween'  => 4
    ],
    1024 => [
      'slidesPerView' => $slidesPerView,
      'spaceBetween'  => 8
    ]
  ],
];

if (in_array('autoplay', $config)) {
  $swiper_config['autoplay'] = [
    'delay' => 2500,
    'disableOnInteraction' => false
  ];

  if (in_array('loop', $config)) {
    $swiper_config['loop'] = true;
  }
}

?>

<section class="ca-container">
  <?php if ($title || $desc) : ?>
    <div class="my-8 text-center text-gray-400">
      <?php if ($title) : ?>
        <h2 class="text-xl md:text-3xl font-bold text-gray-900 dark:text-gray-100">
          <?php echo $title ?? '最新文章'; ?>
        </h2>
      <?php endif; ?>
      <?php if ($desc) : ?>
        <p class="mt-2 excerpt">
          <?php echo $desc ?? ''; ?>
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="swiper mySwiper customer-fb" data-config='<?php echo json_encode($swiper_config); ?>'>
    <div class="swiper-wrapper pb-10">
      <?php foreach ($data as $item) : ?>
        <div class="swiper-slide ca-border rounded-md">
          <div class="border-b dark:border-b-gray-700 p-2 flex items-center">
            <div class="flex w-full items-center">
              <img src="<?php echo $item['_img']; ?>" class="w-10 h-10 rounded-full" alt="">
              <div class="ml-2">
                <p class="dark:text-gray-100"><?php echo $item['_name']; ?></p>
                <p class="text-sm text-gray-400"><?php echo $item['_job']; ?></p>
              </div>
            </div>
            <i class="iconify text-4xl" data-icon="el:wordpress"></i>
          </div>
          <p class="p-4 excerpt">
            <?php echo $item['_content']; ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>


    <?php if (in_array('dots', $config)) : ?>
      <div class="swiper-pagination swiper-customer-fb-pagination mt-8"></div>
    <?php endif; ?>

  </div>

  <?php if (in_array('nav', $config)) : ?>
    <div class="swiper-button-prev swiper-customer-fb-prev hidden 2xl:block text-primary hover:text-primary-hover absolute top-1/2 translate-y-1/2 -left-10"></div>
    <div class="swiper-button-next swiper-customer-fb-next hidden 2xl:block text-primary hover:text-primary-hover absolute top-1/2 translate-y-1/2 -right-10"></div>

  <?php endif; ?>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const el = document.querySelector('.customer-fb');

    new Swiper(el, JSON.parse(el.dataset.config));
  });
</script>
