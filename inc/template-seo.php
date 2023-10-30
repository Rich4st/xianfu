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

    $keywords = '';
    $desc     = '';
    $title    = '';

    if (is_home() || is_front_page()) {
      $title            = get_bloginfo('name') . $this->separator . get_bloginfo('description');
      $keywords         = $this->site_seo_config['keywords'];
      $desc             = $this->site_seo_config['description'];
    } elseif (is_singular()) {
      $title    = get_post_meta($post->ID, 'post_title', true);
      $keywords = get_post_meta($post->ID, 'post_keywords', true);
      $desc     = get_post_meta($post->ID, 'post_description', true);
    } elseif (is_category() || is_tag()) {
      $title    = single_cat_title('', false);
      $keywords = get_term_meta(get_queried_object_id(), 'cate_keywords', true);
      $desc     = get_term_meta(get_queried_object_id(), 'cate_description', true);
    }

    if (!empty($keywords) || !empty($desc) || !empty($title)) {
      $title    = trim(strip_tags($title));
      $keywords = trim(strip_tags($keywords));
      $desc     = trim(strip_tags($desc));

      echo '<title>' . $title . '</title>';
      echo '<meta name="keywords" content="' . $keywords . '" />';
      echo '<meta name="description" content="' . $desc . '" />';
    }
  }

  //标题修正优化
  public function _wp_get_document_title()
  {
      return '123456';
  }
}