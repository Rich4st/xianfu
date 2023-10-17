const body = jQuery("body");
const html = jQuery("html");
var lazyLoadInstance = null;

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
    lazyLoadInstance = new LazyLoad();
    lazyLoadInstance.update();
  },

  // 加载更多
  load_more: function () {
    const load_buttons = document.querySelectorAll('#load-more');

    if (load_buttons.length <= 0) return;

    load_buttons.forEach(button => {
      const loading_icon = button.querySelector('.loading-icon');

      button.addEventListener('click', function () {

        capalot.ajax({
          data: {
            action: 'capalot_load_more',
            paged: parseInt(button.dataset.page) + 1,
            style: button.dataset.style,
            style_config: JSON.stringify(button.dataset.config)
          },
          beforeSend: function () {
            loading_icon.classList.remove('hidden');
          },
          complete: function ({ responseJSON }) {
            const { data, code, has_next } = responseJSON;

            if (code === 200) {
              if (!has_next) {
                button.classList.add('hidden');
                button.nextElementSibling.classList.remove('hidden');
              }

              loading_icon.classList.add('hidden');

              $(`#${button.dataset.ul}`).append(data);
              button.dataset.page = parseInt(button.dataset.page) + 1;
              lazyLoadInstance.update();
            }
          }
        })
      })
    })
  }
};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
