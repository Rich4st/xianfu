const body = jQuery("body");
const html = jQuery("html");
var lazyLoadInstance = null;

let capalot = {
  init: function () {

    capalot.toggle_dark();
    capalot.lazyload();
    capalot.load_more();
    capalot.attribute_click();
    capalot.side_menu();
    capalot.add_comment();
    capalot.swiper();
    capalot.content_menu();

    capalot.code_block();
    capalot.popper_init();
  },

  /**
   * ajax请求
   * @param {object} data 请求数据
   * @param {function} beforeSend 发送请求前回调
   * @param {function} success 请求成功回调
   * @param {function} complete 请求完成回调
   */
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

  /**
   * toast 提示
   * @param {string} title 标题
   * @param {string} icon 图标 'success' | 'error'
   * @param {number} timer 延迟时间 ms后自动关闭
   * @param {function} cb 关闭后回调
   */
  toast: function ({
    title = '成功', icon = 'success', timer = 2000, cb = () => { }
  }) {
    Swal.fire({
      title,
      icon,
      timer,
      toast: true,
      position: 'top',
      showConfirmButton: false,
      customClass: {
        container: 'mt-10'
      }
    }).then(cb())
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
        theme: 'translucent',
        placement: 'top',
        allowHTML: true,
        interactive: true,
        maxWidth: 500,
        arrow: true,
        onShown() {
          if(button.dataset.show ==='copyText') {
            capalot.copyText();
          }
        }
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
      i.classList.add('cursor-pointer');
      i.classList.add('hover:bg-gray-100')
      i.setAttribute('data-icon', 'mingcute:right-fill');

      i.style.position = 'absolute';
      i.style.width = '2rem';
      i.style.right = '0';
      i.style.top = '10px';
      i.style.marginLeft = '1rem'

      item.insertBefore(i, item.firstChild);
    })

  },

  // 添加评论
  add_comment: function () {
    const commentform = jQuery("#commentform");
    commentform.find('input[type="submit"]');
    commentform.submit(function (e) {
      e.preventDefault();
      const submit_button = jQuery("#submit");

      const comment = commentform.serialize().split('&').map(item => item.split('=')[1])[0];

      if (comment === '') {
        capalot.toast({
          title: '评论内容不能为空',
          icon: 'error',
        })
        return;
      }

      jQuery.ajax({
        type: "POST",
        url: g_p.ajax_url,
        data: commentform.serialize() + "&action=capalot_ajax_comment&nonce=" + g_p.ajax_nonce,
        beforeSend: function () {
          submit_button.val('提交中...');
        },
        error: function ({ responseText: errorMsg }) {
          console.log(errorMsg);
          capalot.toast({
            title: errorMsg,
            icon: 'error',
          })
        },
        success: function (response) {
          console.log(response);
          const { msg } = response;

          if (msg !== '评论成功') {
            capalot.toast({
              title: response,
              icon: 'error',
            })
            return;
          }

          capalot.toast({
            title: msg,
            cb: () => {
              window.location.reload();
            }
          });
        },
        complete: function (e) {
          submit_button.val('提交评论')
        }
      })
    });
    var comments_list = jQuery(".comments-list");
    const scroll_button = jQuery(".infinite-scroll-button");
    const scroll_status = jQuery(".infinite-scroll-status");
    const scroll_msg = jQuery(".infinite-scroll-msg");
    scroll_button.length && (
      comments_list.on("request.infiniteScroll", function (e, t) {
        scroll_status.show()
      }),
      comments_list.on("load.infiniteScroll", function (e, t, n) {
        scroll_status.hide()
      }),
      comments_list.on("last.infiniteScroll", function (e, t, n) {
        scroll_button.hide(), scroll_msg.show()
      }),
      comments_list.infiniteScroll({
        append: ".comments-list > *",
        debug: !1,
        hideNav: ".comments-pagination",
        history: !1,
        path: ".comments-pagination a.next",
        prefill: !1,
        scrollThreshold: !1,
        button: ".infinite-scroll-button"
      })
    )
  },

  // 轮播初始化
  swiper: function () {
    const swipers = document.querySelectorAll('.mySwiper');

    if (swipers.length === 0) return;

    swipers.forEach((el) => {
      new Swiper(el, JSON.parse(el.dataset.config));
    })
  },

  // 文章目录
  content_menu: function () {
    if (!g_p.hasOwnProperty('post_id')) return;;

    const btn = document.querySelectorAll('#content-menu-btn');

    if (btn.length === 0) return;

    btn.forEach(el => {
      el.addEventListener('click', function () {
        const menu = el.parentNode.parentNode.querySelector('#content-menu-body');
        menu.classList.toggle('hidden');
      })
    })
  },

  // code block
  code_block: function () {
    const blocks = document.querySelectorAll('pre code');

    blocks.forEach((block) => {
      const preElement = block.parentNode;

      const codeHeader = document.createElement('div');
      codeHeader.className = 'code-header flex items-center justify-between py-1 px-6 bg-gray-500';

      const lang = block.className.split('-')[1];
      const langText = document.createElement('span');
      langText.innerText = lang;
      codeHeader.appendChild(langText);

      const copyBtn = document.createElement('button');
      copyBtn.className = 'copy-button';
      copyBtn.setAttribute('aria-label', 'Copy Code');
      const copyIcon = document.createElement('i');
      copyIcon.className = 'iconify';
      copyIcon.setAttribute('data-icon', 'mdi:content-copy');
      copyBtn.appendChild(copyIcon);
      codeHeader.appendChild(copyBtn);

      preElement.insertBefore(codeHeader, block);

      copyBtn.addEventListener('click', () => capalot.copyToClipboard(block, copyBtn));
    });
  },
  copyToClipboard: function (block, button) {
    const code = block.innerText;
    const buttonIcon = button.innerHTML;

    const input = document.createElement('input');
    input.value = code;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);

    button.innerText = '复制成功!';

    setTimeout(() => {
      button.innerHTML = buttonIcon;
    }, 2000);
  },

  //全局复制事件
  copyText: function() {
    const copyBtn = document.querySelectorAll('#copy-btn');

    if (copyBtn.length === 0) return;

    copyBtn.forEach((btn) => {
      const btnIcon = btn.innerHTML;

      btn.addEventListener('click', function() {
        const text = btn.parentNode.querySelector('.copy-text');
        const input = document.createElement('input');
        input.value = text.innerText;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);

        btn.innerText = '复制成功!';

        setTimeout(() => {
          btn.innerHTML = btnIcon;
        }, 2000);
      })
    })
  }

};

document.addEventListener('DOMContentLoaded', () => {
  capalot.init();
})
