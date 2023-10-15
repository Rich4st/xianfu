<?php

$post_id = get_the_ID();

$product_images = capalot_get_product_gallery($post_id);

?>

<div class="swiper thumbs-gallery">
  <div class="swiper-wrapper">
    <?php foreach ($product_images as $image) : ?>
      <div class="swiper-slide">
        <img src="<?php echo $image; ?>" />
      </div>
    <?php endforeach; ?>
  </div>
</div>
<div thumbsSlider="" class="swiper mySwiper mt-4 max-w-xs mx-auto">
  <div class="swiper-wrapper">
    <?php foreach ($product_images as $image) : ?>
      <div class="swiper-slide">
        <img class="w-20 h-20" src="<?php echo $image; ?>" />
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script defer>
  // 判断页面是否渲染完成
  document.onreadystatechange = function() {
    if (document.readyState == "complete") {
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true
      });
      var swiper2 = new Swiper(".thumbs-gallery", {
        loop: true,
        spaceBetween: 10,
        thumbs: {
          swiper: swiper
        }
      });
    }
  }
</script>
