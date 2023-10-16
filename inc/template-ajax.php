<?php

new CapalotAjax();

class CapalotAjax
{

  // 请求前缀
  private $__ajax_prefix = 'wp_ajax_capalot_';
  // 未登录用户请求前缀
  private $__ajax_nopriv_prefix = 'wp_ajax_nopriv_capalot_';

  public function __construct()
  {
    $this->init();
  }

  public function init(): Void
  {
    $this->add_api('load_more', 0); // 加载更多
  }

  public function add_api($hook_name, $type = 1): void
  {
    if ($type === 1)
      add_action($this->__ajax_prefix . $hook_name, [$this, $hook_name]);
    else
      add_action($this->__ajax_nopriv_prefix . $hook_name, [$this, $hook_name]);
  }

  public function api_template($data, $extra = []): array
  {
    return array_merge(
      [
        'code' => 200,
        'msg'  => '成功',
        'data' => $data,
      ],
      $extra,
    );
  }

  public function load_more()
  {
    $item_style = $_POST['style'];
    $item_config = $_POST['style_config'];
    // 将json格式$item_config转换为数组
    $item_config = json_decode(json_decode(stripslashes($item_config), true), true);
    $paged = $_POST['paged'];

    $Posts = new WP_Query([
      'post_status' => 'publish',
      'paged'       => $paged,
    ]);

    $response = '';
    $max_page = $Posts->max_num_pages;

    if ($Posts->have_posts()) {
      while ($Posts->have_posts()) : $Posts->the_post();
        ob_start();

        get_template_part('template-parts/loop/' . $item_style, '', $item_config);

        $response .= ob_get_clean();
      endwhile;
    }

    wp_send_json(
      $this->api_template(
        $response,
        [
          'max_page' => $max_page
        ]
      )
    );
  }
}
