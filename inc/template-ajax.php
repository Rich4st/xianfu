<?php


new Capalot_Ajax();

class Capalot_Ajax
{

  // 请求前缀
  private $__ajax_prefix = 'wp_ajax_capalot_';
  // 未登录用户请求前缀
  private $__ajax_nopriv_prefix = 'wp_ajax_nopriv_capalot_';

  public function __construct()
  {
    $this->init();
  }

  private function add_api($hook_name, $type = 1)
  {
    if ($type === 1)
      add_action($this->__ajax_prefix . $hook_name, [$this, $hook_name]);
    else
      add_action($this->__ajax_nopriv_prefix . $hook_name, [$this, $hook_name]);
  }

  private function init()
  {
    $this->add_api('load_more'); //加载更多文章
  }

  function api_template($data = null, $extra = []): array
  {
    return array_merge(
      [
        'code' => $data === null ? 201 : 200,
        'msg'  => $extra['msg'] ?? '成功',
        'data' => $data,
      ],
      $extra,
    );
  }

  function load_more()
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

    if($Posts->max_num_pages < $paged) {
      wp_send_json(
        $this->api_template(null, [ 'msg' => '没有更多了'])
      );
    }

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
          'has_next' => $paged < $max_page,
        ]
      )
    );
  }
}
