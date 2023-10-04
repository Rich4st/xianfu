<?php

/**
 * @description 轮播图组件
 *
 * @see https://github.com/Rich4st/base/blob/develop/preview/section-2.jpg?raw=true
 */
?>

<div id="default-swiper" class="swiper mySwiper default-swiper rounded-xl overflow-auto">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img class="relative left-1/2 -translate-x-1/2 w-screen max-h-[80vh]" src="<?php echo get_template_directory_uri() ?>/assets/images/swiper-1.jpg" alt="">
    </div>
    <div class="swiper-slide">
      <img class="relative left-1/2 -translate-x-1/2 w-screen max-h-[80vh]" src="<?php echo get_template_directory_uri() ?>/assets/images/swiper-1.jpg" alt="">
    </div>
    <div class="swiper-slide">
      <img class="relative left-1/2 -translate-x-1/2 w-screen max-h-[80vh]" src="<?php echo get_template_directory_uri() ?>/assets/images/swiper-1.jpg" alt="">
    </div>
    <div class="swiper-slide">
      <img class="relative left-1/2 -translate-x-1/2 w-screen max-h-[80vh]" src="<?php echo get_template_directory_uri() ?>/assets/images/swiper-1.jpg" alt="">
    </div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/swiper-bundle.min.js"></script>

<script>
  if (Swiper) {
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  }
</script>
