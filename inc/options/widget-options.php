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
        'container-full' => '全宽',
        'container'      => '普通',
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
      'id' => 'spaceBetween',
      'type' => 'number',
      'title' => '幻灯片列间距',
      'unit' => 'px',
      'default' => '0',
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

  echo $args['before_widget'];

  get_template_part('template-parts/widget/home/slider', '', $instance);

  echo $args['after_widget'];
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
      'desc' => '当前最新发布更新的热门资源，我们将会持续保持更新'
    ),
    $instance
  );

  echo $args['before_widget'];

  get_template_part('template-parts/widget/home/latest-posts', '', $instance);

  echo $args['after_widget'];
}
