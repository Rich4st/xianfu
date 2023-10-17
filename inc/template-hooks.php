<?php

// 输出文章缩略图url
function capalot_get_thumbnail_url($post = null, $size = 'thumbnail')
{
  if (empty($post)) {
    global $post;
  } else {
    $post = get_post($post);
  }

  if (!$post instanceof WP_Post) {
    echo get_default_thumbnail_src();
    return;
  }

  if (has_post_thumbnail($post)) {
    echo get_the_post_thumbnail_url($post, $size);
    return;
  } elseif (_capalot('is_post_one_thumbnail', true) && !empty($post->post_content)) {
    // 使用文章第一张图片作为缩略图
    ob_start();
    ob_end_clean();
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (!empty($matches[1][0])) {
      echo $matches[1][0];
      return;
    }
  }

  echo get_default_thumbnail_src();
}

// 获取默认缩略图
function get_default_thumbnail_src()
{
  return _capalot('default_thumb') ? _capalot('default_thumb') : get_template_directory_uri() . '/assets/img/thumb.jpg';
}

/**
 * 输出分类信息
 *
 * @pram $num 分类数量
 * @return html li标签输出分类html
 */
function capalot_post_category($num = 2)
{
  $categories = get_the_category();
  $separator = ' ';
  $output = '';
  if ($categories) {
    foreach ($categories as $key => $category) {
      if ($key == $num) {
        break;
      }
      $output .=  '<li class="flex items-center w-fit hover:text-pink-500 dark:text-gray-100 dark:hover:text-pink-500">
      <i class="iconify" data-icon="ri:price-tag-3-line"></i>' .
        '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_html($category->name) . '">' . esc_html($category->name) .
        '</a></li>' . $separator;
    }
    echo trim($output, $separator);
  }
}

/**
 * 输出文章描述
 *
 * @pram $limit 截取长度
 * @return html 输出文章描述
 */
function capalot_post_excerpt($limit = '48')
{
  $excerpt = get_the_excerpt();

  if (empty($excerpt)) {
    $excerpt = get_the_content();
  }

  echo wp_trim_words(strip_shortcodes($excerpt), $limit, '...');
}

// 输出文章最近修改时间
function capalot_postupdate_time()
{
  $time = get_the_time('U');

  $time_string = sprintf(
    '<time class="pub-date" datetime="%1$s">%2$s</time>',
    esc_attr(get_the_date(DATE_W3C)),
    esc_html(human_time_diff($time, current_time('timestamp')) . '前')
  );

  if (false) {
    // 显示最近修改时间
    $modified_time = get_the_modified_time('U');
    if ($time != $modified_time) {
      $time_string .= sprintf(
        '<time class="mod-date" datetime="%1$s">%2$s</time>',
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(human_time_diff($modified_time, current_time('timestamp')) . '前')
      );
    }
  }

  echo $time_string;
}

/**
 * 点击加载更多按钮
 *
 * @param $config 配置项
 * @param $config['style'] 列表样式 grid | grid-overlay
 * @param $config['ul_id'] 列表id
 * @param $config['style_config'] 列表样式配置
 *
 * @return html 输出加载更多按钮
 */
function capalot_load_more($config)
{
  $config['style_config'] = htmlspecialchars($config['style_config'], ENT_QUOTES, 'UTF-8');

  echo '<div class=" text-sm text-center py-6">
    <button id="load-more" data-page="1" data-style="' . $config['style'] . '" data-ul="' . $config['ul_id'] . '" data-config="' . $config['style_config'] . '" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200  rounded-full px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
    <i class="iconify loading-icon text-base inline-block hidden" data-icon="eos-icons:three-dots-loading"></i>加载更多
    </button>
    <p id="no-more-post" class="text-gray-400 hidden">没有更多了...</p>
  </div>';
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
