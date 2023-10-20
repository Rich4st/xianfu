<?php

if (empty($args)) exit;

$query_args = [
  'post_status' => 'publish',
  'category__in' => $args['include'] ?? [],
  'posts_per_page' => $args['total'] ?? 6,
];

$PostData = new WP_Query($query_args);

$config = [
  'lazy' => true,
  'navigation' => [
    'nextEl' => '.swiper-button-next',
    'prevEl' => '.swiper-button-prev',
  ],
  'breakpoints' => [
    320 => [
      'slidesPerView' => 2,
    ],
    768 => [
      'slidesPerView' => 3,
    ],
    1024 => [
      'slidesPerView' => $args['slidesPerView'],
    ]
  ],
]
?>

<section class="xf-container">
  <?php if ($args['title'] || $args['desc']) : ?>
    <div class="my-8 text-center text-gray-400">
      <?php if ($args['title']) : ?>
        <h2 class="text-xl md:text-3xl font-bold text-gray-900 dark:text-gray-100">
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

  <div class="swiper mySwiper slider-post" data-config='<?php echo json_encode($config); ?>'>
    <div class="swiper-wrapper py-0.5">

      <?php
      if ($PostData->have_posts()) :
        while ($PostData->have_posts()) : $PostData->the_post() ?>

          <div class="swiper-slide border-r  dark:border-r-gray-700 hover:shadow-[rgba(50,_50,_105,_0.15)_0px_2px_5px_0px,_rgba(0,_0,_0,_0.05)_0px_1px_1px_0px] dark:border-b-2 dark:border-b-transparent dark:hover:border-b-pink-500">
            <div class="relative">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php capalot_get_thumbnail_url(); ?>" class="w-full h-40 object-cover">
              </a>
              <div class="text-xs my-2 space-y-1 px-2">
                <ul class="flex items-center space-x-2">
                  <?php capalot_post_category(2); ?>
                </ul>

                <a class="block text-base w-fit font-bold text-gray-600 hover:text-black dark:text-gray-100 dark:hover:text-gray-300 hover:underline" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?></a>

                <p class="text-gray-400 line-clamp-1" title="<?php capalot_post_excerpt(40); ?>">
                  <?php capalot_post_excerpt(40); ?>
                </p>

                <ul class="flex items-center space-x-2 text-gray-400">
                  <li>
                    <?php capalot_postupdate_time(); ?>
                  </li>
                  <li class="flex items-center">
                    <i class="iconify mr-1 text-sm" data-icon="ph:eye-fill"></i>
                    <span>99+</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

      <?php
        endwhile;
      endif;
      ?>

    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</section>
