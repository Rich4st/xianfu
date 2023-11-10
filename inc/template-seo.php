<?php

new CapalotSEO();

class CapalotSEO
{

  public $is_seo = false;
  public $is_no_cate = false;
  public $site_seo_config = [];
  public $separator = '-';

  public function __construct()
  {
    $this->is_seo = _capalot('is_theme_seo', false);
    $this->is_no_cate = _capalot('site_no_cate', false);
    $this->site_seo_config = _capalot('site_seo', []);
    $this->separator = _capalot('site_seo:separator', '-');

    if (!$this->is_seo && !is_array($this->site_seo_config)) {
      return;
    }

    add_filter('wp_head', array($this, '_wp_head'), 5);
  }

  public function _wp_head()
  {
    global $post;

    $title    = '';
    $keywords = '';
    $desc     = '';

    if (is_home() || is_front_page()) {
      $title            = get_bloginfo('name') . $this->separator . get_bloginfo('description');
      $keywords         = $this->site_seo_config['keywords'];
      $desc             = $this->site_seo_config['description'];
    } elseif (is_singular()) {
      $title    = get_post_meta($post->ID, 'post_title', true);
      $keywords = get_post_meta($post->ID, 'post_keywords', true);
      $desc     = get_post_meta($post->ID, 'post_description', true);
    } elseif (is_category() || is_tag()) {
      // archive页面SEO设置
      $title    = get_term_meta(get_queried_object_id(), 'title', true) ?? single_cat_title('', false);
      $title    = $title . ' - ' . get_bloginfo('name');
      $desc     = get_term_meta(get_queried_object_id(), 'description', true);
      $keywords = get_term_meta(get_queried_object_id(), 'keywords', true);
    }

    // 自定义网站favicon
    if(_capalot('site_favicon')) {
      echo '<link rel="shortcut icon" href="' . _capalot('site_favicon') . '" />';
    }

    if (!empty($keywords) || !empty($desc) || !empty($title)) {
      $title    = trim(strip_tags($title));
      $keywords = trim(strip_tags($keywords));
      $desc     = trim(strip_tags($desc));

      is_singular() ? $title .= ' - ' . get_bloginfo('name') : '';

      echo '<title>' . $title . '</title>';
      echo '<meta name="description" content="' . $desc . '" />';
      echo '<meta name="keywords" content="' . $keywords . '" />';
    }
  }

}
