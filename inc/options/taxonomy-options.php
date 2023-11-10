<?php

defined('ABSPATH') || exit;

if (!class_exists('CSF')) {
  exit;
}

$prefix = '_capalot_taxonomy_options';

CSF::createTaxonomyOptions($prefix, array(
  'taxonomy'  => array('category', 'post_tag'),
  'data_type' => 'unserialize',
));

CSF::createSection($prefix, array(
  'fields'  => array(

    [
      'id'    => 'bg',
      'type'  => 'upload',
      'title' => '特色图片',
      'desc'  => '分类特色图片',
    ],

    [
      'id'    => 'title',
      'type'  => 'text',
      'title' => 'SEO标题',
      'desc'  => '不填写则为分类名称',
    ],

    [
      'id'    => 'description',
      'type'  => 'textarea',
      'title' => 'SEO描述',
      'desc'  => '字数控制到80-180最佳',
    ],

    [
      'id'    => 'keywords',
      'type'  => 'textarea',
      'title' => 'SEO关键词',
      'desc'  => '多个关键词用英文逗号隔开',
    ]

  )
));
