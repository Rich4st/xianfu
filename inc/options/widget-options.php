<?php

defined('ABSPATH') || exit;


/**
 * 首页 - 幻灯片模块
 */
CSF::createWidget('capalot_home_slider_widget', array(
  'title' => '幻灯片模块',
  'className' => 'home-slider-widget',
  'desc' => '首页幻灯片模块',
  'fields'      => array(

    array(
      'id'      => 'container',
      'type'    => 'radio',
      'title'   => '布局宽度',
      'inline'  => true,
      'options' => array(
        ''             => '全宽',
        'ca-container' => '普通',
      ),
      'default' => 'container-full',
    ),

    array(
      'id'      => 'config',
      'type'    => 'checkbox',
      'title'   => '幻灯片配置',
      'options' => array(
        'autoplay' => '自动播放',
        'loop'     => '循环播放',
        'nav'      => '切换按钮',
        'dots'     => '导航圆点',
      ),
      'inline'  => true,
      'default' => array('autoplay', 'nav'),
    ),

    array(
      'id'          => 'slidesPerView',
      'type'        => 'number',
      'title'       => '幻灯片列数',
      'unit'        => '列',
      'output'      => '.heading',
      'output_mode' => 'width',
      'default'     => '1',
    ),

    array(
      'id'         => 'spaceBetween',
      'type'       => 'number',
      'title'      => '幻灯片列间距',
      'unit'       => 'px',
      'default'    => '0',
      'dependency' => array('slidesPerView', '>', '1'),
    ),

    array(
      'id'     => 'data',
      'type'   => 'group',
      'title'  => '幻灯片内容配置',
      'fields' => array(
        array(
          'id'      => '_img',
          'type'    => 'upload',
          'title'   => '上传幻灯片',
          'default' => get_template_directory_uri() . '/assets/img/slider.jpg',
        ),
        array(
          'id'       => '_desc',
          'type'     => 'textarea',
          'title'    => '描述内容，支持html代码',
          'sanitize' => false,
          'default'  => '<h3 class="text-2xl font-bold">Hello,</h3><p class="hidden md:block">这是一个简单的内容展示,您可以随意插入HTML代码任意组合显示.</p>',
        ),
        array(
          'id'      => '_href',
          'type'    => 'text',
          'title'   => '链接地址',
          'default' => '',
        ),
        array(
          'id'      => '_target',
          'type'    => 'radio',
          'title'   => '链接打开方式',
          'inline'  => true,
          'options' => array(
            '_self'  => '默认',
            '_blank' => '新窗口打开',
          ),
          'default' => '_self',
        ),

      ),

    ),

  ),
));
function capalot_home_slider_widget($args, $instance)
{

  $instance = array_merge(

    array(
      'container' => 'container-full',
      'config' => array('autoplay'),
      'items' => 1,
      'data' => [],
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/slider', '', $instance);
}

/**
 * 首页 - 最新文章组件
 */
CSF::createWidget('capalot_home_latest_posts_widget', array(
  'title' => '最新文章组件',
  'className' => 'home-latest-posts-widget',
  'desc' => '首页最新文章组件',
  'fields' => array(

    array(
      'id' => 'title',
      'type' => 'text',
      'title' => '标题',
      'default' => '最新文章',
    ),

    array(
      'id' => 'desc',
      'type' => 'text',
      'title' => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ),

    array(
      'id'  => 'bg_color',
      'type' => 'color',
      'title' => '背景颜色',
      'default' => '#fff',
    ),

    array(
      'id'      => 'style',
      'type'    => 'image_select',
      'title'   => '风格配置',
      'inline'  => true,
      'options' => array(
        'grid'         => $template_dir . '/assets/img/options/item-grid.png',
        'grid-overlay' => $template_dir . '/assets/img/options/item-grid-overlay.png',
        'list'         => $template_dir . '/assets/img/options/item-list.png',
        'title'        => $template_dir . '/assets/img/options/item-title.png',
      ),
      'default' => 'grid',
    ),

    array(
      'id' => 'thumbs_ratio',
      'type' => 'image_select',
      'title' => '缩略图比例',
      'inline' => true,
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
      'id'      => 'cols',
      'type'    => 'number',
      'title'   => '展示列数',
      'unit'    => '列',
      'default' => '4',
    ),

    array(
      'id'      => 'extra_info',
      'type'    => 'checkbox',
      'title'   => '辅助信息显示',
      'options' => array(
        'category' => '显示分类',
        'desc'   => '显示摘要',
        'footer' => '显示时间，阅读数点赞数等',
      ),
      'inline'  => true,
      'default' => array('category', 'desc', 'footer'),
    ),

    array(
      'id'          => 'exclude',
      'type'        => 'checkbox',
      'inline'      => true,
      'title'       => '要排除的分类',
      'placeholder' => '选择要排除的分类',
      'options'     => 'categories',
    ),

    array(
      'id' => 'is_pagination',
      'type' => 'switcher',
      'title' => '是否开启分页',
      'default' => true,
    ),

    array(
      'type'    => 'subheading',
      'content' => '文章数请在 WP后台->设置->阅读->博客页面至多显示 调整',
    ),

  )
));
function capalot_home_latest_posts_widget($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
      'id'    => 'lp-' . end(explode('_', $args['widget_id'])),
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/latest-posts', '', $instance);
}

/**
 * 首页 - 幻灯片文章组件
 */
CSF::createWidget('capalot_home_slider_posts_widget', array(
  'title'     => '幻灯片文章组件',
  'className' => 'home-slider-posts-widget',
  'desc'      => '首页幻灯片文章组件',
  'fields'    => [

    array(
      'id' => 'title',
      'type' => 'text',
      'title' => '标题',
      'default' => '最新文章',
    ),

    array(
      'id' => 'desc',
      'type' => 'text',
      'title' => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ),

    array(
      'id'      => 'total',
      'type'    => 'number',
      'title'   => '共展示多少文章',
      'unit'    => '篇',
      'default' => '6',
    ),

    array(
      'id'      => 'slidesPerView',
      'type'    => 'number',
      'title'   => '展示列数',
      'unit'    => '列',
      'default' => '4',
    ),

    array(
      'id'          => 'include',
      'type'        => 'checkbox',
      'inline'      => true,
      'title'       => '要展示的分类',
      'placeholder' => '选择要展示的分类',
      'options'     => 'categories',
    ),
  ]
));
function capalot_home_slider_posts_widget($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/slider-posts', '', $instance);
}

/**
 * 首页 - 幻灯片文章组件 - 带属性切换
 */
CSF::createWidget('capalot_home_slider_posts_attributes_widget', array(
  'title'     => '幻灯片组件-带属性切换',
  'className' => 'home-slider-posts-widget',
  'desc'      => '首页幻灯片组件-带属性切换',
  'fields'    => [

    array(
      'id' => 'title',
      'type' => 'text',
      'title' => '标题',
      'default' => '最新文章',
    ),

    array(
      'id' => 'desc',
      'type' => 'text',
      'title' => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ),

    array(
      'id'     => 'data',
      'type'   => 'group',
      'title'  => '幻灯片内容配置',
      'fields' => array(
        array(
          'id'       => '_attribute',
          'type'     => 'group',
          'title'    => '属性配置',
          'fields'   => array(
            array(
              'id'      => '_title',
              'type'    => 'text',
              'title'   => '属性标题',
              'default' => '热门',
            ),
            array(
              'id'      => '_img',
              'type'    => 'upload',
              'title'   => '属性图片',
            )
          ),
        ),
        array(
          'id'       => '_desc',
          'type'     => 'textarea',
          'title'    => '描述内容，支持html代码',
          'sanitize' => false,
          'default'  => '这是一个简单的内容展示,您可以随意插入HTML代码任意组合显示.',
        ),
        array(
          'id'      => '_href',
          'type'    => 'text',
          'title'   => '链接地址',
          'default' => '',
        ),
        array(
          'id'      => '_target',
          'type'    => 'radio',
          'title'   => '链接打开方式',
          'inline'  => true,
          'options' => array(
            '_self'  => '默认',
            '_blank' => '新窗口打开',
          ),
          'default' => '_self',
        ),

      ),

    ),
  ]
));
function capalot_home_slider_posts_attributes_widget($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/slider-posts-attributes', '', $instance);
}

/**
 * 首页 - 图片背景按钮
 */
CSF::createWidget('capalot_home_background_buttons', array(
  'title'     => '图片背景按钮',
  'className' => 'home-background-buttons',
  'desc'      => '首页图片背景按钮',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '主标题',
    ],

    [
      'id'      => 'sub_title',
      'type'    => 'text',
      'title'   => '副标题',
      'default' => '副标题',
    ],

    [
      'id'    => 'img',
      'type'  => 'upload',
      'title' => '背景图片',
    ],

    [
      'id'      => 'is_background_fixed',
      'type'    => 'switcher',
      'title'   => '是否固定背景',
      'default' => true,
    ],

    [
      'id'     => 'buttons',
      'type'   => 'group',
      'title'  => '按钮配置',
      'fields' => [
        [
          'id'      => '_title',
          'type'    => 'text',
          'title'   => '按钮标题',
          'default' => '按钮标题',
        ],
        [
          'id'      => '_href',
          'type'    => 'text',
          'title'   => '按钮链接',
          'default' => '#',
        ],
        [
          'id'    => '_color',
          'type'  => 'color',
          'title' => '按钮颜色',
        ]
      ],
    ]

  )
));
function capalot_home_background_buttons($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '主标题',
      'sub_title' => '副标题',
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/background-buttons', '', $instance);
}

/**
 * 首页 - Services模块
 */
CSF::createWidget('capalot_home_services', array(
  'title'     => 'Services模块',
  'className' => 'home-Services',
  'desc'      => '介绍服务模块',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '主标题'
    ],

    [
      'id'      => 'bg_color',
      'type'    => 'color',
    ],

    [
      'id'      => 'data',
      'type'    => 'group',
      'title'   => '服务模块配置',
      'fields'  => array(

        [
          'id'      => '_title',
          'type'    => 'text',
          'title'   => '服务标题',
          'default' => '服务一'
        ],

        [
          'id'      => '_img',
          'type'    => 'upload',
          'title'   => '上传图片',
          'default' => get_template_directory_uri() . '/assets/img/services/1.png'
        ],

        [
          'id'      => '_content',
          'type'    => 'textarea',
          'title'   => '服务介绍',
          'default' => '服务介绍'
        ]

      )
    ],

    [
      'id'      => 'is_show_button',
      'type'    => 'switcher',
      'title'   => '是否显示按钮',
      'default' => true
    ],

    [
      'id'         => 'button_text',
      'type'       => 'text',
      'title'      => '按钮文字',
      'dependency' => array('is_show_button', '==', 'true'),
    ],

    [
      'id'         => 'button_href',
      'type'       => 'text',
      'title'      => '按钮链接',
      'dependency' => array('is_show_button', '==', 'true'),
    ],

  )
));
function capalot_home_services($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '主标题',
    ),
    $instance
  );

  get_template_part('template-parts/widget/home/services', '', $instance);
}

/**
 * 侧边栏 - 作者信息
 */
CSF::createWidget('capalot_side_author', array(
  'title'     => '作者介绍模块',
  'className' => 'side-author',
  'desc'      => '侧边栏作者介绍模块',
  'fields'    => array(

    [
      'id'      => 'img',
      'type'    => 'upload',
      'title'   => '作者照片',
    ],

    [
      'id'      => 'name',
      'type'    => 'text',
      'title'   => '作者姓名',
    ],

    [
      'id'      => 'info',
      'type'    => 'textarea',
      'title'   => '作者介绍',
    ]

  )
));
function capalot_side_author($args, $instance)
{

  $instance = array_merge(
    array(),
    $instance
  );

  get_template_part('template-parts/widget/side/author', '', $instance);
}

/**
 * 侧边栏 - 文章分类
 */
CSF::createWidget('capalot_side_categories', array(
  'title'     => '【侧边栏】文章分类模块',
  'className' => 'side-categories',
  'desc'      => '侧边栏文章分类模块',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '文章分类'
    ],

    [
      'id'      => 'exclude',
      'type'    => 'checkbox',
      'inline'  => true,
      'title'   => '要排除的分类',
      'options' => 'categories',
    ]
  )
));
function capalot_side_categories($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '文章分类',
    ),
    $instance
  );

  get_template_part('template-parts/widget/side/categories', '', $instance);
}

/**
 * 侧边栏 - 近期文章
 */
CSF::createWidget('capalot_side_latest_post', array(
  'title'     => '【侧边栏】近期文章模块',
  'className' => 'side-latest-post',
  'desc'      => '侧边栏近期文章模块',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '近期文章'
    ],

    [
      'id'      => 'exclude',
      'type'    => 'checkbox',
      'inline'  => true,
      'title'   => '要排除的分类',
      'options' => 'categories',
    ],

    [
      'id'      => 'total',
      'type'    => 'number',
      'title'   => '共展示多少文章',
      'unit'    => '篇',
      'default' => '6',
    ]
  )
));
function capalot_side_latest_post($args, $instance)
{

  $instance = array_merge(
    array(
      'title' => '近期文章',
    ),
    $instance
  );

  get_template_part('template-parts/widget/side/latest-post', '', $instance);
}
