let currentPage = 1;
const body = jQuery("body");

let capalot = {
  init: function () {
    const swiperEl = document.querySelector('.swiper');
    if (swiperEl)
      capalot.swiper();
  },

  // 轮播初始化
  swiper: function () {
    const swipers = document.querySelectorAll('.mySwiper');

    swipers.forEach((el) => {
      new Swiper(el, JSON.parse(el.dataset.config));
      console.log(JSON.parse(el.dataset.config));
    })
  },
};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
