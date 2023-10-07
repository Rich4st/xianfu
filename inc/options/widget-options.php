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
