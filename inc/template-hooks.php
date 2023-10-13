<?php

// 获取缩略图url
function capalot_get_thumbnail_url($post = null, $size = 'thumbnail')
{
  if (empty($post)) {
    global $post;
  } else {
    $post = get_post($post);
  }

  if (!$post instanceof WP_Post) {
    return get_default_thumbnail_src();
  }

  if (has_post_thumbnail($post)) {
    return get_the_post_thumbnail_url($post, $size);
  } elseif (_capalot('is_post_one_thumbnail', true) && !empty($post->post_content)) {
    ob_start();
    ob_end_clean();
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (!empty($matches[1][0])) {
      return $matches[1][0];
    }
  }

  return get_default_thumbnail_src();
}

// 获取默认缩略图
function get_default_thumbnail_src()
{
  return _capalot('default_thumb') ? _capalot('default_thumb') : get_template_directory_uri() . '/assets/img/thumb.jpg';
}

// 获取文章列表显示风格配置
function get_posts_style_config($cat_id = 0)
{
  $item_col = _capalot('archive_item_col', '4');
  $item_style = _capalot('archive_item_style', 'grid');
  $media_size = _capalot('post_thumbnail_size', 'radio-3x2');

  $media_size_type = get_thumbnail_size_type();
  $media_align_type = get_thumbnail_align_type();

  $item_entry = _capalot('archive_item_entry', array(
    'category_dot',
    'entry_desc',
    'entry_footer',
    'vip_icon',
  ));

  $term_item_style = _capalot('site_term_item_style', []);

  if (!empty($cat_id) && !empty($term_item_style)) {
    foreach ($term_item_style as $key => $item) {
      if ($cat_id == $item['cat_id']) {
        $item_col   = $item['archive_item_col'];
        $item_style = $item['archive_item_style'];
        $media_size = $item['post_thumbnail_size'];
        $item_entry = $item['archive_item_entry'];
        continue;
      }
    }
  }


  $row_cols = [
    '1' => 'grid-cols-1 gap-4',
    '2' => 'grid-cols-1 md:grid-cols-2 gap-4',
    '3' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ',
    '4' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4',
    '5' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xxl:grid-cols-5 gap-4',
    '6' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xxl:grid-cols-5 xxxl:grid-cols-6 gap-4',
  ];

  if ($item_style == 'list' && $item_col >= 2) {
    // 列表模式自适应...
    $row_cols_class = 'grid-cols-1 md:grid-cols-2 gap-4 ';
  } else {
    $row_cols_class = $row_cols[$item_col];
  }

  $config = array(
    'type'            => $item_style, //grid grid-overlay list list-icon
    'row_cols_class'  => $row_cols_class,
    'media_size_type' => $media_size_type,
    'media_fit_type'  => $media_align_type,
    'media_class'     => $media_size, // media-3x2 media-3x3 media-2x3
    'is_vip_icon'     => @in_array('vip_icon', $item_entry),
    'is_entry_desc'   => @in_array('entry_desc', $item_entry),
    'is_entry_meta' => @in_array('entry_footer', $item_entry),
    'is_entry_cat' => @in_array('category_dot', $item_entry),
  );
  return $config;
}

// 获取文章缩略图尺寸
function get_thumbnail_size_type()
{
  $options = ['bg-cover', 'bg-auto', 'bg-contain'];
  $option = _capalot('site_thumb_size_type', 'bg-cover');

  if (!in_array($option, $options))
    $option = $options[0];

  return $option;
}

// 获取文章缩略图对齐方式
function get_thumbnail_align_type()
{
  $options = [
    'bg-left-top', 'bg-right-top', 'bg-center-top',
    'bg-left-center', 'bg-right-center', 'bg-center',
    'bg-left-bottom', 'bg-right-bottom', 'bg-center-bottom'
  ];
  $option = _capalot('site_thumb_fit_type', 'bg-center');

  if (!in_array($option, $options))
    $option = $options[0];

  return $option;
}

// 获取分类信息
function capalot_meta_category($num = 2)
{
  $categories = get_the_category();
  $separator = ' ';
  $output = '';
  if ($categories) {
    foreach ($categories as $key => $category) {
      if ($key == $num) {
        break;
      }
      $output .=  '<li class="flex items-center hover:text-pink-500 dark:text-gray-400 dark:hover:text-pink-500">
      <i class="iconify" data-icon="ri:price-tag-3-line"></i>' .
        '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_html($category->name) . '">' . esc_html($category->name) .
        '</a></li>' . $separator;
    }
    echo trim($output, $separator);
  }
}

// 获取文章描述
function capalot_get_post_excerpt($limit = '48')
{
  $excerpt = get_the_excerpt();

  if (empty($excerpt)) {
    $excerpt = get_the_content();
  }

  echo wp_trim_words(strip_shortcodes($excerpt), $limit, '...');
}

// 获取商品标签
function capalot_get_post_tags($post_id = null)
{
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }

  // 获取文章标签
  $post_tags = get_the_tags($post);

  // 输出文章标签
  if (!empty($post_tags)) {
    foreach ($post_tags as $tag) {
      echo '<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#' . $tag->name . '</span>';
    }
  }
}

// 获取商品图库
function capalot_get_product_gallery($post_id = null)
{
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }

  $gallery_ids = get_post_meta($post_id, 'product_images', true);

  $gallery_ids = explode(',', $gallery_ids);

  if (empty($gallery_ids)) {
    return [];
  }

  $gallery = [];

  foreach ($gallery_ids as $id) {
    $gallery[] = wp_get_attachment_image_src($id, 'full')[0];
  }

  return $gallery;
}

// 获取商品价格
function capalot_get_product_price($post_id = null)
{
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }

  $product_info = get_post_meta($post_id, 'product_info', true);

  echo $product_info['product_price'];
}
