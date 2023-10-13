let currentPage = 1;
const body = jQuery("body");

let capalot = {
  init: function () {

    capalot.swiper();
    capalot.toggle_dark();
    capalot.lazyload();
  },

  // 轮播初始化
  swiper: function () {
    const swipers = document.querySelectorAll('.mySwiper');

    if (swipers.length === 0) return;

    swipers.forEach((el) => {
      new Swiper(el, JSON.parse(el.dataset.config));
      console.log(JSON.parse(el.dataset.config));
    })
  },

  // 深色模式切换
  toggle_dark: function () {
    const switcher = document.querySelector('.toggle-dark');

    if (!switcher) return;

    switcher.addEventListener('click', function () {
      body.toggleClass('dark');
    })
  },

  // 懒加载配置
  lazyload: function () {
    console.log(LazyLoad);
    var lazyLoadInstance = new LazyLoad();
    lazyLoadInstance.update();
  }
};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
