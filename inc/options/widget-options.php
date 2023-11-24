<?php

defined('ABSPATH') || exit;


/**
 * 首页 - 幻灯片模块
 */
CSF::createWidget('capalot_home_slider_widget', array(
  'title'       => '【首页】幻灯片模块',
  'className'   => 'home-slider-widget',
  'desc'        => '首页幻灯片模块',
  'fields'      => array(

    [
      'id'      => 'container',
      'type'    => 'radio',
      'title'   => '布局宽度',
      'inline'  => true,
      'options' => [
        ''             => '全宽',
        'ca-container' => '普通',
      ],
      'default' => 'container-full',
    ],

    [
      'id'      => 'config',
      'type'    => 'checkbox',
      'title'   => '幻灯片配置',
      'options' => [
        'autoplay' => '自动播放',
        'loop'     => '循环播放',
        'nav'      => '切换按钮',
        'dots'     => '导航圆点',
      ],
      'inline'  => true,
      'default' => array('autoplay', 'nav'),
    ],

    [
      'id'          => 'slidesPerView',
      'type'        => 'number',
      'title'       => '幻灯片列数',
      'unit'        => '列',
      'output'      => '.heading',
      'output_mode' => 'width',
      'default'     => '1',
    ],

    [
      'id'         => 'spaceBetween',
      'type'       => 'number',
      'title'      => '幻灯片列间距',
      'unit'       => 'px',
      'default'    => '0',
      'dependency' => ['slidesPerView', '>', '1'],
    ],

    array(
      'id'     => 'data',
      'type'   => 'group',
      'title'  => '幻灯片内容配置',
      'fields' => array(
        [
          'id'      => '_img',
          'type'    => 'upload',
          'title'   => '上传幻灯片',
          'default' => get_template_directory_uri() . '/assets/img/slider.jpg',
        ],
        [
          'id'       => '_desc',
          'type'     => 'textarea',
          'title'    => '描述内容，支持html代码',
          'sanitize' => false,
          'default'  => '<h3 class="text-2xl font-bold">Hello,</h3><p class="hidden md:block">这是一个简单的内容展示,您可以随意插入HTML代码任意组合显示.</p>',
        ],
        [
          'id'      => '_href',
          'type'    => 'text',
          'title'   => '链接地址',
          'default' => '',
        ],
        [
          'id'      => '_target',
          'type'    => 'radio',
          'title'   => '链接打开方式',
          'inline'  => true,
          'options' => [
            '_self'  => '默认',
            '_blank' => '新窗口打开',
          ],
          'default' => '_self',
        ],

      ),

    ),

  ),
));
function capalot_home_slider_widget($args, $instance)
{

  $instance = array_merge(

    [
      'container' => 'container-full',
      'config' => array('autoplay'),
      'items' => 1,
      'data' => [],
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/slider', '', $instance);
}

/**
 * 首页 - 最新文章组件
 */
CSF::createWidget('capalot_home_latest_posts_widget', array(
  'title' => '【首页】最新文章组件',
  'className' => 'home-latest-posts-widget',
  'desc' => '首页最新文章组件',
  'fields' => array(

    [
      'id' => 'title',
      'type' => 'text',
      'title' => '标题',
      'default' => '最新文章',
    ],

    [
      'id' => 'desc',
      'type' => 'text',
      'title' => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ],

    [
      'id'  => 'bg_color',
      'type' => 'color',
      'title' => '背景颜色',
      'default' => '#fff',
    ],

    [
      'id'      => 'style',
      'type'    => 'radio',
      'title'   => '展示风格',
      'inline'  => true,
      'options' => [
        'grid'            => '网格',
        'grid-overlay'    => '网格遮罩',
        'grid-readmore'   => '文章',
      ],
      'default' => 'grid',
    ],

    array(
      'id'      => 'thumbs_ratio',
      'type'    => 'radio',
      'title'   => '缩略图比例',
      'inline'  => true,
      'options' => [
        'ratio-1x1'  => '1:1',
        'ratio-2x3'  => '2:3',
        'ratio-3x2'  => '3:2',
        'ratio-3x4'  => '3:4',
        'ratio-4x3'  => '4:3',
        'ratio-16x9' => '16:9',
      ],
      'default' => 'ratio-3x2',
    ),

    [
      'id'      => 'cols',
      'type'    => 'number',
      'title'   => '展示列数',
      'unit'    => '列',
      'default' => '4',
    ],

    [
      'id'      => 'extra_info',
      'type'    => 'checkbox',
      'title'   => '辅助信息显示',
      'options' => [
        'category' => '显示分类',
        'desc'   => '显示摘要',
        'footer' => '显示时间，阅读数点赞数等',
      ],
      'inline'  => true,
      'default' => ['category', 'desc', 'footer'],
    ],

    [
      'id'          => 'exclude',
      'type'        => 'checkbox',
      'inline'      => true,
      'title'       => '要排除的分类',
      'placeholder' => '选择要排除的分类',
      'options'     => 'categories',
    ],

    [
      'id' => 'is_pagination',
      'type' => 'switcher',
      'title' => '是否开启分页',
      'default' => true,
    ],

    [
      'type'    => 'subheading',
      'content' => '文章数请在 WP后台->设置->阅读->博客页面至多显示 调整',
    ],

  )
));
function capalot_home_latest_posts_widget($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
      'id'    => 'lp-' . end(explode('_', $args['widget_id'])),
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/latest-posts', '', $instance);
}

/**
 * 首页 - 幻灯片文章组件
 */
CSF::createWidget('capalot_home_slider_posts_widget', array(
  'title'     => '【首页】幻灯片文章组件',
  'className' => 'home-slider-posts-widget',
  'desc'      => '首页幻灯片文章组件',
  'fields'    => array(

    [
      'id' => 'title',
      'type' => 'text',
      'title' => '标题',
      'default' => '最新文章',
    ],

    [
      'id' => 'desc',
      'type' => 'text',
      'title' => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ],

    [
      'id'      => 'total',
      'type'    => 'number',
      'title'   => '共展示多少文章',
      'unit'    => '篇',
      'default' => '6',
    ],

    [
      'id'      => 'slidesPerView',
      'type'    => 'number',
      'title'   => '展示列数',
      'unit'    => '列',
      'default' => '4',
    ],

    [
      'id'          => 'include',
      'type'        => 'checkbox',
      'inline'      => true,
      'title'       => '要展示的分类',
      'placeholder' => '选择要展示的分类',
    ],

  )
));
function capalot_home_slider_posts_widget($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/slider-posts', '', $instance);
}

/**
 * 首页 - 幻灯片文章组件 - 带属性切换
 */
CSF::createWidget('capalot_home_slider_posts_attributes_widget', array(
  'title'     => '【首页】幻灯片组件-带属性切换',
  'className' => 'home-slider-posts-widget',
  'desc'      => '首页幻灯片组件-带属性切换',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '最新文章',
    ],

    [
      'id'      => 'desc',
      'type'    => 'text',
      'title'   => '描述介绍',
      'default' => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ],

    [
      'id'     => 'data',
      'type'   => 'group',
      'title'  => '幻灯片内容配置',
      'fields' => array(
        [
          'id'       => '_attribute',
          'type'     => 'group',
          'title'    => '属性配置',
          'fields'   => [
            [
              'id'      => '_title',
              'type'    => 'text',
              'title'   => '属性标题',
              'default' => '热门',
            ],

            [
              'id'      => '_img',
              'type'    => 'upload',
              'title'   => '属性图片',
            ]
          ],
        ],

        [
          'id'       => '_desc',
          'type'     => 'textarea',
          'title'    => '描述内容，支持html代码',
          'sanitize' => false,
          'default'  => '这是一个简单的内容展示,您可以随意插入HTML代码任意组合显示.',
        ],

        [
          'id'      => '_href',
          'type'    => 'text',
          'title'   => '链接地址',
          'default' => '',
        ],

        [
          'id'       => '_target',
          'type'     => 'radio',
          'title'    => '链接打开方式',
          'inline'   => true,
          'options'  => [
            '_self'  => '默认',
            '_blank' => '新窗口打开',
          ],
          'default'  => '_self',
        ],

      ),
    ],

  )
));
function capalot_home_slider_posts_attributes_widget($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '最新推荐',
      'desc'  => '当前最新发布更新的热门资源，我们将会持续保持更新',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/slider-posts-attributes', '', $instance);
}

/**
 * 首页 - 图片背景按钮
 */
CSF::createWidget('capalot_home_background_buttons', array(
  'title'     => '【首页】图片背景按钮',
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
    [
      'title' => '主标题',
      'sub_title' => '副标题',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/background-buttons', '', $instance);
}

/**
 * 首页 - Services模块
 */
CSF::createWidget('capalot_home_services', array(
  'title'     => '【首页】Services模块',
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
    [
      'title' => '主标题',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/services', '', $instance);
}

/**
 * 首页 - 客户反馈
 */
CSF::createWidget('capalot_home_customer_fb', array(
  'id'        => 'capalot_home_customer_fb',
  'title'     => '【首页】客户反馈轮播',
  'className' => 'home-customer-fb',
  'desc'      => '首页客户反馈轮播',
  'fields'    => array(

    [
      'id'    => 'title',
      'type'  => 'text',
      'title' => '标题',
    ],

    [
      'id'    => 'desc',
      'type'  => 'text',
      'title' => '描述',
    ],

    [
      'id'      => 'config',
      'type'    => 'checkbox',
      'title'   => '幻灯片配置',
      'options' => [
        'autoplay' => '自动播放',
        'loop'     => '循环播放',
        'nav'      => '切换按钮',
        'dots'     => '导航圆点',
      ],
      'inline'  => true,
      'default' => array('autoplay', 'nav'),
    ],

    [
      'id'          => 'slidesPerView',
      'type'        => 'number',
      'title'       => '幻灯片列数',
      'unit'        => '列',
      'output'      => '.heading',
      'output_mode' => 'width',
      'default'     => '1',
    ],

    [
      'id'         => 'spaceBetween',
      'type'       => 'number',
      'title'      => '幻灯片列间距',
      'unit'       => 'px',
      'default'    => '0',
      'dependency' => ['slidesPerView', '>', '1'],

    ],

    [
      'id'      => 'data',
      'type'    => 'group',
      'title'   => '客户反馈配置',
      'fields'  => array(

        [
          'id'      => '_img',
          'type'    => 'upload',
          'title'   => '客户头像',
          'default' => get_template_directory_uri() . '/assets/img/customer-fb/1.png'
        ],

        [
          'id'      => '_from',
          'type'    => 'text',
          'title'   => '客户来源',
        ],

        [
          'id'      => '_content',
          'type'    => 'textarea',
          'title'   => '客户反馈内容',
          'default' => '客户反馈内容'
        ],

        [
          'id'      => '_name',
          'type'    => 'text',
          'title'   => '客户姓名',
          'default' => '客户姓名'
        ],

        [
          'id'      => '_job',
          'type'    => 'text',
          'title'   => '客户职位',
          'default' => '客户职位'
        ]

      )
    ],

  )
));
function capalot_home_customer_fb($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '客户反馈',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/customer-fb', '', $instance);
}

/**
 * 首页 - hero模块
 */
CSF::createWidget('capalot_home_hero', array(
  'id'        => 'capalot_home_hero',
  'title'     => '【首页】hero模块',
  'className' => 'home-hero',
  'desc'      => '首页hero模块',
  'fields'    => array(

    [
      'id'    => 'title',
      'type'  => 'text',
      'title' => '标题',
    ],

    [
      'id'      => 'is_typed',
      'type'    => 'switcher',
      'title'   => '是否开启打字效果,如果要输入多行文字,请用英文逗号分隔',
      'default' => true,
    ],

    [
      'id'    => 'desc',
      'type'  => 'text',
      'title' => '描述',
    ],

    [
      'id'      => 'bg_type',
      'type'    => 'radio',
      'title'   => '背景类型',
      'inline'  => true,
      'options' => [
        'img'     => '图片',
        'video'   => '视频',
        'waves'   => '动态方块',
        'clouds'  => '动态天空',
        'net'     => '动态线条',
        'halo'    => '动态流光',
      ],
      'default'   => 'img'
    ],

    [
      'id'        => 'bg_overlay',
      'type'      => 'switcher',
      'title'     => '是否开启背景遮罩',
      'default'   => true,
    ],

    [
      'id'         => 'bg_img',
      'type'       => 'upload',
      'title'      => '背景图片',
      'dependency' => array('bg_type', '==', 'img'),
    ],

    [
      'id'         => 'bg_video',
      'type'       => 'upload',
      'title'      => '背景视频',
      'dependency' => array('bg_type', '==', 'video'),
    ]

  )
));
function capalot_home_hero($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '主标题',
      'desc'  => '副标题',
    ],
    $instance
  );

  get_template_part('template-parts/widget/home/hero', '', $instance);
}

/**
 * 侧边栏 - 作者信息
 */
CSF::createWidget('capalot_side_author', array(
  'title'     => '【侧边栏】作者介绍模块',
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
    [],
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
      'id'      => 'only_current_cat',
      'type'    => 'switcher',
      'title'   => '仅显示当前分类(可在分类页侧边栏中使用)',
      'default' => false,
    ],

    [
      'id'         => 'exclude',
      'type'       => 'checkbox',
      'inline'     => true,
      'title'      => '要排除的分类',
      'options'    => 'categories',
      'dependency' => array('only_current_cat', '==', 'false'),
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
    [
      'title' => '近期文章',
      'total' => 6
    ],
    $instance
  );

  get_template_part('template-parts/widget/side/latest-post', '', $instance);
}

/**
 * 侧边栏 - 标签云
 */
CSF::createWidget('capalot_side_tag_cloud', array(
  'title'    => '【侧边栏】标签云模块',
  'className' => 'side-tag-cloud',
  'desc'      => '侧边栏标签云模块',
  'fields'    => array(

    [
      'id'      => 'title',
      'type'    => 'text',
      'title'   => '标题',
      'default' => '标签云'
    ],

    [
      'id'      => 'exclude',
      'type'    => 'checkbox',
      'inline'  => true,
      'title'   => '要排除的标签',
      'options' => 'tags',
    ]

  )
));
function capalot_side_tag_cloud($args, $instance)
{

  $instance = array_merge(
    [
      'title' => '标签云',
    ],
    $instance
  );

  get_template_part('template-parts/widget/side/tag-cloud', '', $instance);
}
