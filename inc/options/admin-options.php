<?php

defined('ABSPATH') || exit;

// CSF框架未加载,退出程序
if (!class_exists('CSF')) {
  return;
}

$prefix = _OPTIONS_PREFIX;
$template_dir = get_template_directory_uri();

/** 主题设置 */
CSF::createOptions($prefix, array(
  'menu_title' => '主题设置',
  'menu_slug' => 'capalot',
));

/**
 * 基本设置
 */
CSF::createSection($prefix, array(
  'title'  => '基本设置',
  'icon' => 'dashicons dashicons-admin-generic',
  'fields' => array(

    array(
      'id'      => 'site_logo',
      'type'    => 'upload',
      'title'   => '网站LOGO',
      'default' => _capalot('site_logo', get_template_directory_uri() . '/assets/img/logo.png'),
    ),

    array(
      'id'      => 'site_favicon',
      'type'    => 'upload',
      'title'   => '网站favicon图标',
      'default' => _capalot('site_favicon', get_template_directory_uri() . '/assets/img/favicon.png'),
    ),

    array(
      'id' => 'site_dark_mode',
      'type' => 'switcher',
      'title' => '网站暗黑模式',
      'desc' => '开启后,网站可以切换白天黑夜模式',
      'default' => false,
    )

  ),
));

/**
 * 布局设置
 */
CSF::createSection($prefix, array(
  'id' => 'layout_options',
  'icon' => 'dashicons dashicons-media-document',
  'title' => '布局设置',
));

// 布局设置 - 全局颜色风格
CSF::createSection($prefix, array(
  'parent' => 'layout_options',
  'title' => '全局颜色风格',
  'fields' => array(

    array(
      'type'    => 'submessage',
      'style'   => 'info',
      'content' => '根据你的个人喜好合理设置配色,设置随时保存前台刷新页面观察效果',
    ),

    array(
      'id'      => 'is_site_dark_toggle',
      'type'    => 'switcher',
      'title'   => '网站亮色暗黑模式切换',
      'desc'    => '开启后,网站可以切换白天黑夜模式',
      'default' => true,
    ),

    array(
      'id'          => 'site_default_color_mode',
      'type'        => 'radio',
      'inline'      => true,
      'title'       => '网站默认颜色模式',
      'desc'        => '自动模式为当地时间早6点开始到晚18点为白天模式,其后为黑夜模式,系统自动时候别时区。',
      'placeholder' => '',
      'options'     => array(
        'light' => '亮色（白天）',
        'dark'  => '深色（黑夜）',
        'auto'  => '自动（早晚）',
      ),
      'default'     => 'light',
    ),

    array(
      'id'          => 'site_container_width',
      'type'        => 'number',
      'title'       => '网站全局内容区域宽度',
      'desc'        => '（在浏览器宽度1200px以上时的container宽度,其他小屏幕尺寸自适应）留空则默认1200px',
      'unit'        => 'PX',
      'output'      => '.heading',
      'output_mode' => 'width',
      'default'     => '',
    ),

    array(
      'id'    => 'site_background',
      'type'  => 'background',
      'title' => '网站背景配置',
    ),

    array(
      'id'      => 'site_header_color',
      'type'    => 'color_group',
      'title'   => '网站顶部菜单颜色配置',
      'options' => array(
        'bg-color'     => '菜单背景颜色',
        'sub-bg-color' => '子菜单背景颜色',
        'color'        => '文字颜色',
        'hover-color'  => '文字滑中颜色',
      ),
    ),

    array(
      'id'      => 'is_site_home_header_transparent',
      'type'    => 'switcher',
      'title'   => '首页顶部菜单透明',
      'desc'    => '开启后,可以搭配首页模块顶部的全宽搜索模块或者幻灯片展示',
      'default' => false,
    ),

  )
));

// 布局设置 - 文章列表布局
CSF::createSection($prefix, array(
  'parent' => 'layout_options',
  'title' => '文章列表布局',
  'fields' => array(


    array(
      'type'    => 'submessage',
      'style'   => 'info',
      'content' => '根据你网站文章类型前往WP后台设置-媒体-缩略图大小设置缩略图尺寸,常见尺寸300x200 ,300x300 ,400x300,如果你网站大部分文章是采集的,建议点选本页面下方关闭WP自带图片裁剪功能,这样后台上传图片时,不默认裁剪多个缩略图,减少占用空间、因本主题功能支持不同宽度高度列表布局,所以没有完美固定的缩略图尺寸推荐,请根据自己网站整体内容风格尝试不同比例尺寸。如需完美尺寸请固定全站风格为一种布局。',
    ),

    array(
      'id'      => 'default_thumb',
      'type'    => 'upload',
      'title'   => '文章默认缩略图',
      'desc'    => '设置文章默认缩略图（建议和自定义文章缩略图宽高保持一致）',
      'default' => get_template_directory_uri() . '/assets/img/thumb.jpg',
    ),

    array(
      'id'          => 'site_thumb_size_type',
      'type'        => 'radio',
      'inline'      => true,
      'title'       => '缩略图显示模式',
      'desc'        => '',
      'placeholder' => '',
      'options'     => array(
        'bg-cover'   => 'cover：自适应铺满',
        'bg-auto'    => 'auto：原图大小',
        'bg-contain' => 'contain：缩放全图',
      ),
      'default'     => 'bg-cover',
    ),

    array(
      'id'          => 'site_thumb_fit_type',
      'type'        => 'radio',
      'inline'      => true,
      'title'       => '缩略图对齐模式',
      'desc'        => '因网站采用自适应设计,尽可能的在自适应缩略图展示完整的情况根据对齐模式优先对齐展示缩略图',
      'placeholder' => '',
      'options'     => array(
        'bg-left-top'      => '左上',
        'bg-right-top'     => '右上',
        'bg-center-top'    => '中上',
        'bg-center'        => '居中',
        'bg-center-bottom' => '中下',
        'bg-left-bottom'   => '左下',
        'bg-right-bottom'  => '右下',
      ),
      'default'     => 'bg-center',
    ),

    array(
      'id'      => 'is_post_one_thumbnail',
      'type'    => 'switcher',
      'title'   => '自动抓取第一张图片',
      'desc'    => '没设置特色图自动获取文章中第一张图片作为特色图,如果出现抓取的是最后一张的情况,请检查文章内容中的图片是否有回车或者空格隔开,必须隔开才能识别',
      'default' => true,
    ),

    array(
      'id'      => 'disable_wp_thumbnail_crop',
      'type'    => 'switcher',
      'title'   => '关闭WP自带图片裁剪',
      'desc'    => '防止每次上传图片都生成多余缩略图占用空间问题,如果您网站缩略图尺寸单一,建议开启此项',
      'default' => false,
    ),

    array(
      'id'      => 'site_page_nav_type',
      'type'    => 'radio',
      'inline'  => true,
      'title'   => '网站翻页风格模式',
      'desc'    => '',
      'options' => array(
        'click'  => '点击按钮加载更多',
        'auto'   => '下拉自动加载更多',
        'number' => '上/下页翻页按钮',
      ),
      'default' => 'click',
    ),

  ),
));

// 布局设置 - 自定义分类布局
CSF::createSection($prefix, array(
  'parent' => 'layout_options',
  'title'  => '自定义分类布局',
  'fields' => array(
    array(
      'id'                     => 'site_term_item_style',
      'type'                   => 'group',
      'title'                  => '自定义分类页面布局风格',
      'subtitle'               => '单独设置某个分类的布局风格',
      'accordion_title_number' => true,
      'fields'                 => array(
        array(
          'id'         => 'cat_id',
          'type'       => 'select',
          'title'      => '关联分类',
          'desc'       => '配置此分类页面下的布局风格',
          'options'    => 'categories',
          'query_args' => array(
            'orderby' => 'count',
            'order'   => 'DESC',
          ),
        ),

        array(
          'id'      => 'post_thumbnail_size',
          'type'    => 'image_select',
          'title'   => '默认缩略图尺寸比例',
          'desc'    => '常见宽高3:2比例,3:3正方形,2:3比例,',
          'options' => array(
            'ratio-2x3'  => $template_dir . '/assets/img/options/img-2x3.png',
            'ratio-3x4'  => $template_dir . '/assets/img/options/img-3x4.png',
            'ratio-1x1'  => $template_dir . '/assets/img/options/img-1x1.png',
            'ratio-4x3'  => $template_dir . '/assets/img/options/img-4x3.png',
            'ratio-3x2'  => $template_dir . '/assets/img/options/img-3x2.png',
            'ratio-16x9' => $template_dir . '/assets/img/options/img-16x9.png',
            'ratio-21x9' => $template_dir . '/assets/img/options/img-21x9.png',
          ),
          'default' => 'ratio-3x2',
        ),

        array(
          'id'      => 'archive_item_style',
          'type'    => 'image_select',
          'title'   => '分类页默认文章列表展示风格',
          'desc'    => '网格,列表,图片,图标风格',
          'options' => array(
            'grid'         => $template_dir . '/assets/img/options/item-grid.png',
            'grid-overlay' => $template_dir . '/assets/img/options/item-grid-overlay.png',
            'list'         => $template_dir . '/assets/img/options/item-list.png',
            'title'        => $template_dir . '/assets/img/options/item-title.png',
          ),
          'default' => 'grid',
        ),
        array(
          'id'      => 'archive_item_col',
          'type'    => 'image_select',
          'title'   => '分类页默认文章列表展示列数',
          'desc'    => '在最大尺寸1080px宽度时显示列数,其他设备自适应展示',
          'options' => array(
            '1' => $template_dir . '/assets/img/options/col-1.png',
            '2' => $template_dir . '/assets/img/options/col-2.png',
            '3' => $template_dir . '/assets/img/options/col-3.png',
            '4' => $template_dir . '/assets/img/options/col-4.png',
            '5' => $template_dir . '/assets/img/options/col-5.png',
            '6' => $template_dir . '/assets/img/options/col-6.png',
          ),
          'default' => '4',
        ),
        array(
          'id'      => 'archive_item_entry',
          'type'    => 'checkbox',
          'title'   => '列表其他信息显示',
          'options' => array(
            'category_dot' => '显示分类',
            'entry_desc'   => '显示摘要',
            'entry_footer' => '显示时间,阅读数点赞数等',
            // 'vip_icon'     => 'VIP资源标识',
          ),
          'inline'  => true,
          'default' => array('category_dot', 'entry_desc', 'entry_footer', 'vip_icon'),
        ),
      ),
    ),

  ),
));

// 布局设置 - 文章内容页布局
CSF::createSection($prefix, array(
  'parent' => 'layout_options',
  'title'  => '文章内容页布局',
  'fields' => array(

    array(
      'id'      => 'single_style',
      'type'    => 'image_select',
      'title'   => '内容页展示风格',
      'desc'    => '',
      'options' => array(
        'general' => $template_dir . '/assets/img/options/single-style-general.png',
        'hero' => $template_dir . '/assets/img/options/single-style-hero.png',
      ),
      'default' => 'hero',
    ),

    array(
      'id'      => 'single_top_breadcrumb',
      'type'    => 'switcher',
      'title'   => '文章页面包屑导航',
      'desc'    => '',
      'default' => false,
    ),

    array(
      'id'      => 'single_top_title_meta',
      'type'    => 'checkbox',
      'title'   => '文章内容顶部显示小组件',
      'options' => array(
        'date'  => '显示日期时间',
        'cat'   => '显示分类',
        'views' => '显示阅读量',
        'likes' => '显示点赞数',
        'fav'   => '显示收藏数',
        'comment'   => '显示评论数',
      ),
      'inline'  => true,
      'default' => array('date', 'cat', 'views', 'likes', 'fav', 'comment'),
    ),

    array(
      'id'      => 'site_post_content_nav',
      'type'    => 'switcher',
      'title'   => '文章内容侧边栏H目录导航',
      'desc'    => '开启后,自动根据文章内容中的H1、2、3标题生成文章目录,点击可以快速滑动到内容',
      'default' => false,
    ),

    array(
      'id'      => 'single_bottom_copyright',
      'type'    => 'textarea',
      'title'   => '文章内容底部版权信息',
      'sanitize'   => false,
      'desc'    => '不填写则不显示',
      'default' => '声明：本站所有文章,如无特殊说明或标注,均为本站原创发布。任何个人或组织,在未征得本站同意时,禁止复制、盗用、采集、发布本站内容到任何网站、书籍等各类媒体平台。如若本站内容侵犯了原著者的合法权益,可联系我们进行处理。',
    ),

    array(
      'id'      => 'single_bottom_tags',
      'type'    => 'switcher',
      'title'   => '文章内容底部本文标签',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'single_bottom_author',
      'type'    => 'switcher',
      'title'   => '文章内容底部显示本文作者信息',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'single_bottom_action_btn',
      'type'    => 'checkbox',
      'title'   => '文章内容底部功能按钮',
      'options' => array(
        'share' => '分享按钮',
        'fav'   => '收藏按钮',
        'like'  => '点赞按钮',
      ),
      'inline'  => true,
      'default' => array('share', 'fav', 'like'),
    ),

    array(
      'id'      => 'is_single_bottom_navigation',
      'type'    => 'switcher',
      'title'   => '文章页底部上下篇翻页导航',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'single_bottom_related_post_num',
      'type'    => 'number',
      'title'   => '文章底部展示相关文章数量',
      'desc'    => '填写0则关闭,启用后根据当前文章的标签,分类,获取相关文章,如果没有相关文章则不显示',
      'default' => '4',
    ),

  ),
));

// 布局设置 - 网站底部设置
CSF::createSection($prefix, array(
  'parent' => 'layout_options',
  'title'  => '网站底部设置',
  'fields' => array(

    // rollbar
    array(
      'id'      => 'site_fooPC端全站右下角菜单（返回顶部ter_rollbar',
      'type'    => 'group',
      'title'   => '+）',
      'max'     => '10',
      'fields'  => array(
        array(
          'id'      => 'title',
          'type'    => 'text',
          'title'   => '菜单名称',
          'default' => '首页',
        ),
        array(
          'id'    => 'icon',
          'type'  => 'icon',
          'title' => '图标',
          'default' => 'fas fa-bars',
        ),
        array(
          'id'      => 'is_blank',
          'type'    => 'switcher',
          'title'   => '新窗口打开',
          'default' => true,
        ),
        array(
          'id'      => 'href',
          'type'    => 'text',
          'title'   => '链接地址',
          'desc'    => '比如用户中心,填写' . home_url('/user'),
          'default' => home_url(),
        ),

      ),
      'default' => array(
        array(
          'title' => '首页',
          'icon'  => 'fas fa-home',
          'href'  => home_url('/'),
        ),
        array(
          'title' => '用户中心',
          'icon'  => 'far fa-user',
          'href'  => home_url('/user'),
        ),
        array(
          'title' => '会员介绍',
          'icon'  => 'fa fa-diamond',
          'href'  => home_url('/vip-prices'),
        ),
        array(
          'title' => 'QQ客服',
          'icon'  => 'fab fa-qq',
          'href'  => 'http://wpa.qq.com/msgrd?v=3&uin=6666666&site=qq&menu=yes',
        ),
        array(
          'title' => '购买主题',
          'icon'  => 'fab fa-shopware',
          'href'  => 'https://Capalot.com/',
        ),
      ),
    ),

    array(
      'id'      => 'is_site_footer_widget',
      'type'    => 'switcher',
      'title'   => '是否启用网站高级底部',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'         => 'site_footer_logo',
      'type'       => 'upload',
      'title'      => '底部LOGO',
      'default'    => _capalot('site_footer_logo', get_template_directory_uri() . '/assets/img/logo.png'),
      'dependency' => array('is_site_footer_widget', '==', 'true'),
    ),

    array(
      'id'         => 'site_footer_desc',
      'type'       => 'textarea',
      'sanitize'   => false,
      'title'      => '底部LOGO下文字介绍',
      'subtitle'   => '自定义文字介绍',
      'default'    => _capalot('site_footer_desc', 'Capalot是一款强大的Wordpress资源商城主题,支持付费下载、付费播放音视频、付费查看等众多功能。'),
      'dependency' => array('is_site_footer_widget', '==', 'true'),
    ),

    array(
      'id'      => 'site_footer_widget_link1',
      'type'    => 'group',
      'title'   => '底部快速导航链接',
      'max'     => '5',
      'fields'  => array(
        array(
          'id'      => 'title',
          'type'    => 'text',
          'title'   => '链接名称',
          'default' => '链接',
        ),
        array(
          'id'      => 'href',
          'type'    => 'text',
          'title'   => '链接地址',
          'desc'    => '',
          'default' => '#',
        ),
      ),
      'default' => array(
        array(
          'title' => '个人中心',
          'href'  => home_url('/user'),
        ),
        array(
          'title' => '标签云',
          'href'  => home_url('/tags'),
        ),
        array(
          'title' => '网址导航',
          'href'  => home_url('/links'),
        ),
      ),
      'dependency' => array('is_site_footer_widget', '==', 'true'),
    ),
    array(
      'id'      => 'site_footer_widget_link2',
      'type'    => 'group',
      'title'   => '底部关于本站链接',
      'max'     => '5',
      'fields'  => array(
        array(
          'id'      => 'title',
          'type'    => 'text',
          'title'   => '链接名称',
          'default' => '链接',
        ),
        array(
          'id'      => 'href',
          'type'    => 'text',
          'title'   => '链接地址',
          'desc'    => '',
          'default' => '#',
        ),
      ),
      'default' => array(
        array(
          'title' => 'VIP介绍',
          'href'  => home_url('/vip-prices'),
        ),
        array(
          'title' => '客服咨询',
          'href'  => home_url('/user/ticket'),
        ),
        array(
          'title' => '推广计划',
          'href'  => home_url('/user/aff'),
        ),
      ),
      'dependency' => array('is_site_footer_widget', '==', 'true'),
    ),

    array(
      'id'       => 'site_contact_desc',
      'type'     => 'textarea',
      'title'    => '底部联系我们介绍',
      'sanitize' => false,
      'default'  => '<img width="80" height="80" src="' . get_template_directory_uri() . '/assets/img/Capalot-qr.png' . '" style="float: left;" title="二维码"><img width="80" height="80" src="' . get_template_directory_uri() . '/assets/img/Capalot-qr.png' . '" style="float: left;" title="二维码">如有BUG或建议可与我们在线联系或登录本站账号进入个人中心提交工单。',
      'dependency' => array('is_site_footer_widget', '==', 'true'),
    ),


    array(
      'id'       => 'site_copyright_text',
      'type'     => 'textarea',
      'title'    => '全站底部版权信息',
      'sanitize' => false,
      'subtitle' => '自定义版权信息',
      'default'  => _capalot('site_copyright_text', 'Copyright © 2023 <a target="_blank" href="http://Capalot.com/">Capalot Theme</a> - All rights reserved'),
    ),

    array(
      'id'       => 'site_ipc_text',
      'type'     => 'textarea',
      'sanitize' => false,
      'title'    => '网站备案链接',
      'subtitle' => '',
      'default'  => _capalot('site_ipc_text', '<a href="https://beian.miit.gov.cn" target="_blank" rel="noreferrer nofollow">京ICP备0000000号-1</a>'),
    ),

    array(
      'id'       => 'site_ipc2_text',
      'type'     => 'textarea',
      'sanitize' => false,
      'title'    => '网站公安备案链接',
      'subtitle' => '',
      'default'  => _capalot('site_ipc2_text', '<a href="#" target="_blank" rel="noreferrer nofollow">京公网安备 00000000</a>'),
    ),

    array(
      'id'      => 'site_footer_links',
      'type'    => 'group',
      'title'   => '底部友情链接(仅首页显示)',
      'max'     => '20',
      'fields'  => array(
        array(
          'id'      => 'title',
          'type'    => 'text',
          'title'   => '链接名称',
          'default' => '链接',
        ),
        array(
          'id'      => 'href',
          'type'    => 'text',
          'title'   => '链接地址',
          'desc'    => '',
          'default' => '#',
        ),

      ),
      'default' => array(
        array(
          'title' => 'Capalot主题官网',
          'href'  => 'https://Capalot.com/',
        ),
        array(
          'title' => '日主题官网',
          'href'  => 'https://Capalot.com/',
        ),
        array(
          'title' => 'Capalot主题官方',
          'href'  => 'https://Capalot.com/',
        ),
        array(
          'title' => '服务器推荐',
          'href'  => '/goto?url=https://www.aliyun.com/minisite/goods?userCode=u4kxbrjo',
        ),
        array(
          'title' => '免备案服务器',
          'href'  => '/goto?url=https://www.yisu.com/reg/?partner=2OPSd',
        ),
      ),
    ),


  ),
));

/**
 * 网站优化
 */
CSF::createSection($prefix, array(
  'title'  => '网站优化',
  'icon' => 'dashicons dashicons-update',
  'fields' => array(
    array(
      'id'      => 'gutenberg_edit',
      'type'    => 'switcher',
      'title'   => '使用古滕堡编辑器',
      'desc'    => '',
      'default' => false,
    ),

    array(
      'id'      => 'gutenberg_widgets',
      'type'    => 'switcher',
      'title'   => '使用古滕堡小工具',
      'desc'    => '',
      'default' => false,
    ),


    array(
      'id'      => 'site_update_file_md5_rename',
      'type'    => 'switcher',
      'title'   => '上传文件MD5加密重命名',
      'desc'    => '建议开启,可以有效解决中文字符无法上传图片问题,防止付费图片被抓包等',
      'default' => false,
    ),

    array(
      'id'      => 'remove_wptexturize',
      'type'    => 'switcher',
      'title'   => '禁用wordpress文章内容输出转码转义功能',
      'desc'    => '禁用后在编辑器中输入代码乱码将原格式输出,不进行转义,适合有写代码内容的开启。',
      'default' => false,
    ),

    array(
      'id'      => 'show_admin_bar',
      'type'    => 'switcher',
      'title'   => '移除前端顶部管理栏',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_bar_menu',
      'type'    => 'switcher',
      'title'   => '移除WP后台顶部LOGO菜单链接',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_foote_wp',
      'type'    => 'switcher',
      'title'   => '移除wp后台底部版本信息',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_menu',
      'type'    => 'switcher',
      'title'   => '移除WP后台仪表盘菜单',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_emoji',
      'type'    => 'switcher',
      'title'   => '移除WP自带emoji表情插件',
      'desc'    => '可以大幅度精简JS和CSS',
      'default' => true,
    ),

    array(
      'id'      => 'remove_wp_head_more',
      'type'    => 'switcher',
      'title'   => '精简优化网站前台head标签代码',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_wp_img_attributes',
      'type'    => 'switcher',
      'title'   => '精简优化网站图片代码',
      'desc'    => '移除wp自带编辑器插入图片时一堆不必要的html属性和元素',
      'default' => false,
    ),

    array(
      'id'      => 'remove_wp_rest_api',
      'type'    => 'switcher',
      'title'   => '关闭网站REST API接口',
      'desc'    => '如果你有使用小程序等功能,请不要优化此项',
      'default' => false,
    ),
    array(
      'id'      => 'remove_wp_xmlrpc',
      'type'    => 'switcher',
      'title'   => '关闭XML-RPC (pingback) 功能',
      'desc'    => 'XML-RPC 是 WordPress 用于第三方客户端,关闭后可以防止爆破攻击',
      'default' => false,
    ),

  ),
));

/**
 * SEO设置
 */
CSF::createSection($prefix, array(
  'title' => 'SEO设置',
  'icon'   => 'dashicons dashicons-admin-site-alt3',
  'fields' => array(

    array(
      'type'    => 'content',
      'content' => '主题自带SEO优化功能说明：
            <br>1,自带SEO功能包含了自定义文章,首页,页面的TDK功能,自动抓取网站摘要,关键词,自动添加OG协议描述信息等
            <br>2,支持自定义替换wordpress默认的标题链接符号',
    ),

    array(
      'id'      => 'site_no_cate',
      'type'    => 'switcher',
      'title'   => '分类别名category精简',
      'desc'    => '网站文章分类链接去除category/前缀,非特殊需求不必开启,尽量保持WP原有规则',
      'default' => _capalot('site_no_cate', false),
    ),

    array(
      'id'      => 'is_theme_seo',
      'type'    => 'switcher',
      'title'   => '主题内置的SEO功能',
      'label'   => '有部分用户在用插件做SEO,可以在此关闭主题自带SEO功能',
      'default' => true,
    ),

    array(
      'id'         => 'site_seo',
      'type'       => 'fieldset',
      'title'      => '内置SEO设置',
      'fields'     => array(
        array(
          'id'      => 'separator',
          'type'    => 'text',
          'title'   => '全站链接符',
          'desc'    => '一经选择,切勿中途更改,对SEO不友好,一般为“-”或“_”',
          'default' => _capalot('site_seo:separator', '-'),
        ),
        array(
          'id'         => 'keywords',
          'type'       => 'text',
          'title'      => '网站关键词',
          'desc'       => '3-5个关键词,用英文逗号隔开',
          'attributes' => array(
            'style'    => 'width: 100%;',
          ),
          'default'    => _capalot('site_seo:keywords', ''),
        ),
        array(
          'id'       => 'description',
          'type'     => 'textarea',
          'sanitize' => false,
          'title'    => '网站描述',
          'default'  => _capalot('site_seo:description', ''),
        ),

      ),
      'dependency' => array('is_theme_seo', '==', 'true'),
    ),

  ),
));
