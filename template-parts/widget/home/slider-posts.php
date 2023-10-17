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
    'prevEl' => '.swiper-button-prev'
  ],
  'slidesPerView' => $args['slidesPerView'] ?? 4, // 幻灯片列数
  'spaceBetween' => $args['spaceBetween'], // 幻灯片列间距
]
?>

<section>
  <div class="flex-col-center max-w-6xl p-8 mx-auto text-center text-sm text-gray-400">
    <h2 class="text-xl md:text-3xl font-bold leading-tight text-gray-900 dark:text-gray-100">
      <?php echo $args['title'] ?? ''; ?>
    </h2>
    <p class="mt-2 md:text-lg text-gray-500 dark:text-gray-400">
      <?php echo $args['desc'] ?? ''; ?>
    </p>
  </div>

  <div class="swiper mySwiper mx-auto" data-config='<?php echo json_encode($config); ?>'>
    <div class="swiper-wrapper ">

      <?php
      if ($PostData->have_posts()) :
        while ($PostData->have_posts()) : $PostData->the_post() ?>

          <div class="swiper-slide text-white">
            <div class="relative">
              <img src="<?php capalot_get_thumbnail_url(); ?>" class="w-full h-40 object-cover">
              <div class="text-xs my-2 space-y-1">
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

    <div class="swiper-button-next after:text-white"></div>
    <div class="swiper-button-prev after:text-white"></div>
  </div>
</section>
