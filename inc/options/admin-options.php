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
    ),


    array(
      'id'          => 'site_default_color_mode',
      'type'        => 'radio',
      'inline'      => true,
      'title'       => '网站默认颜色模式',
      'desc'        => '自动模式为当地时间早6点开始到晚18点为白天模式,其后为黑夜模式,系统自动识别时区。',
      'placeholder' => '',
      'dependency'  => array('site_dark_mode', '==', 'true'),
      'options'     => array(
        'light' => '亮色（白天）',
        'dark'  => '深色（黑夜）',
        'auto'  => '自动（早晚）',
      ),
      'default'     => 'light',
    ),

  ),
));

/**
 * 内容配置
 */
CSF::createSection($prefix, array(
  'title'  => '内容配置',
  'icon'   => 'dashicons dashicons-admin-users',
  'fields' => array(

    [
      'id'     => 'contact_list',
      'type'   => 'group',
      'title'  => '联系方式',
      'fields' => array(

        [
          'id'    => 'is_wx',
          'type'  => 'switcher',
          'title' => '是否显示微信联系方式',
          'default' => false,
        ],
        [
          'id'    => 'wx_fieldset',
          'type'  => 'fieldset',
          'title' => '微信联系方式',
          'dependency' => array('is_wx', '==', 'true'),
          'fields' => [
            [
              'id'    => 'wx_qrcode',
              'type'  => 'upload',
              'title' => '微信二维码',
            ],
            [
              'id'    => 'wx_text',
              'type'  => 'text',
              'title' => '微信号',
            ],
          ],
        ],

        [
          'id'    => 'is_qq',
          'type'  => 'switcher',
          'title' => '是否显示QQ联系方式',
          'default' => false,
        ],
        [
          'id'    => 'qq_fieldset',
          'type'  => 'fieldset',
          'title' => 'QQ联系方式',
          'dependency' => array('is_qq', '==', 'true'),
          'fields' => [
            [
              'id'    => 'qq_qrcode',
              'type'  => 'upload',
              'title' => 'QQ二维码',
            ],
            [
              'id'    => 'qq_text',
              'type'  => 'text',
              'title' => 'QQ号',
            ],
          ],
        ],

        [
          'id'      => 'is_email',
          'type'    => 'switcher',
          'title'   => '是否显示邮箱联系方式',
          'default' => false,
        ],
        [
          'id'    => 'email_fieldset',
          'type'  => 'text',
          'title' => '邮箱地址',
          'dependency' => array('is_email', '==', 'true'),
        ],

        [
          'id'      => 'is_phone',
          'type'    => 'switcher',
          'title'   => '是否显示电话联系方式',
          'default' => false,
        ],
        [
          'id'    => 'phone_fieldset',
          'type'  => 'text',
          'title' => '电话号码',
          'dependency' => array('is_phone', '==', 'true'),
        ],

        [
          'id'      => 'is_x',
          'type'    => 'switcher',
          'title'   => '是否显示X(twitter)联系方式',
          'default' => false,
        ],
        [
          'id'         => 'x_fieldset',
          'type'       => 'text',
          'title'      => 'x(twitter)链接',
          'dependency' => array('is_x', '==', 'true'),
        ],

        [
          'id'      => 'is_fb',
          'type'    => 'switcher',
          'title'   => '是否显示FaceBook联系方式',
          'default' => false,
        ],
        [
          'id'         => 'fb_fieldset',
          'type'       => 'text',
          'title'      => 'FaceBook链接',
          'dependency' => array('is_fb', '==', 'true'),
        ],

        [
          'id'      => 'is_ins',
          'type'    => 'switcher',
          'title'   => '是否显示Instagram联系方式',
        ],
        [
          'id'         => 'ins_fieldset',
          'type'       => 'text',
          'title'      => 'Instagram链接',
          'dependency' => array('is_ins', '==', 'true'),
        ]

      )
    ]

  )
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
      'id'      => 'remove_wp_head_more',
      'type'    => 'switcher',
      'title'   => '精简优化网站前台head标签代码',
      'desc'    => '',
      'default' => true,
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
