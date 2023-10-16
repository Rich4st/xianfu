let currentPage = 1;
const body = jQuery("body");
const html = jQuery("html");

let capalot = {
  init: function () {

    capalot.swiper();
    capalot.toggle_dark();
    capalot.lazyload();
    capalot.load_more();
  },

  ajax: function ({ data, beforeSend, success, complete, error = () => console.log('error') }) {
    $.ajax({
      type: 'Post',
      url: g_p.ajax_url,
      dataType: 'json',
      data,
      async: true,
      beforeSend,
      success,
      complete,
      error,
    })
  },

  // 轮播初始化
  swiper: function () {
    const swipers = document.querySelectorAll('.mySwiper');

    if (swipers.length === 0) return;

    swipers.forEach((el) => {
      new Swiper(el, JSON.parse(el.dataset.config));
    })
  },

  // 深色模式切换
  toggle_dark: function () {
    const switcher = document.querySelector('.toggle-dark');

    if (!switcher) return;

    switcher.addEventListener('click', function () {
      html.toggleClass('dark');
    })
  },

  // 懒加载配置
  lazyload: function () {
    var lazyLoadInstance = new LazyLoad();
    lazyLoadInstance.update();
  },

  // 加载更多
  load_more: function () {
    const load_button = document.querySelector('#load-more');

    if (!load_button) return;

    load_button.addEventListener('click', function () {
      currentPage++;

      capalot.ajax({
        data: {
          action: 'capalot_load_more',
          paged: currentPage,
          style: load_button.dataset.style,
          style_config: JSON.stringify(load_button.dataset.config)
        },
        complete: function ({ responseJSON }) {
          const { data, code, max_page } = responseJSON;

          if (code === 200) {
            $(`#${load_button.dataset.ul}`).append(data)
            console.log(data);
          }
        }
      })
    })
  }
};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
