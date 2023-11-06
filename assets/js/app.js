const body = jQuery("body");
const html = jQuery("html");
var lazyLoadInstance = null;

let capalot = {
  init: function () {

    capalot.swiper();
    capalot.toggle_dark();
    capalot.lazyload();
    capalot.load_more();
    capalot.attribute_click();
    capalot.popper_init();
    capalot.side_menu();
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
      const icons = switcher.querySelectorAll('svg');
      icons.forEach(icon => icon.classList.toggle('hidden'));

      switcher.setAttribute('aria-checked', switcher.getAttribute('aria-checked') === 'true' ? 'false' : 'true');

      if (html.hasClass('light')) {
        html.removeClass('light');
        html.addClass('dark');

        document.cookie = "theme=dark;path=/";
      } else {
        html.removeClass('dark');
        html.addClass('light');

        document.cookie = "theme=light;path=/";
      }
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
  },

  // attribute
  attribute_click: function () {
    const attr_buttons = document.querySelectorAll('#swiper-attribute');

    if (attr_buttons.length <= 0) return;

    attr_buttons.forEach(button => {

      button.addEventListener('click', function () {
        const img = button.parentNode.parentNode.querySelector('img');
        if (img.src === button.dataset.attr) return;

        img.src = button.dataset.attr;
        img.alt = button.dataset.content;
      })
    })
  },

  // popper
  popper_init: function () {
    const buttons = document.querySelectorAll('.popper-button')

    if (buttons.length <= 0) return;

    buttons.forEach(button => {

      tippy(button, {
        content: button.dataset.content,
        theme: 'light',
        placement: 'top',
        allowHTML: true,
        interactive: true,
        maxWidth: 500,
        arrow: true,
      })
    })
  },

  // side-menu
  side_menu: function () {
    const openButton = document.getElementById("menu-icon");
    const closeButton = document.getElementById("closeSidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    openButton.addEventListener("click", function () {
      sidebar.classList.remove("translate-x-full");
      overlay.classList.remove("hidden");
    });

    closeButton.addEventListener("click", function () {
      sidebar.classList.add("translate-x-full");
      overlay.classList.add("hidden");
      overlay.classList.remove("opacity-50");
    });

    overlay.addEventListener("click", function () {
      sidebar.classList.add("translate-x-full");
      overlay.classList.add("hidden");
    });

    const menuItems = document.querySelectorAll(".menu-item-has-children");

    menuItems.forEach(menu => {
      menu.addEventListener('click', function () {
        const subMenu = menu.querySelector('.sub-menu');
        subMenu.style.display === 'block' ? subMenu.style.display = 'none' : subMenu.style.display = 'block';
      })
    })

    const itemsHasChildren = document.querySelectorAll('.sidebar-main-menu .menu-item-has-children');

    itemsHasChildren.forEach(item => {
      const i = document.createElement('i');

      i.classList.add('iconify');
      i.classList.add('hover:bg-gray-100');
      i.setAttribute('data-icon', 'mingcute:right-fill');

      i.style.position = 'absolute';
      i.style.width = '2rem';
      i.style.right = '0';
      i.style.top = '10px';
      i.style.marginLeft = '1rem'

      item.insertBefore(i, item.firstChild);
    })

  }
};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
