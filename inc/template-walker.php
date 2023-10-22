<?php

class Capalot_Walker_Nav_Menu  extends Walker_Nav_Menu
{

  public $db_fields = array(
    'parent' => 'menu_id_parent',
    'id'     => 'db_id'
  );
  protected $mega;

  public  function __construct($mega = false)
  {
    $this->mega = $mega;
  }

  public function start_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
  }

  public function end_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
  {
    $indent       = ($depth) ? str_repeat("\t", $depth) : '';
    $classes      = empty($data_object->classes) ? array() : (array) $data_object->classes;
    $keep_classes = ['menu-item', 'menu-item-has-children'];

    $classes     = array_intersect($classes, $keep_classes);
    $class_name  = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $data_object, $args, $depth));
    $class_names = $class_name ? ' class="' . esc_attr($class_name) . '"' : '';

    $current_object_id = '';

    $output .= $indent . '<li' . $current_object_id . $class_names . '>';

    $atts           = array();
    $atts['title']  = !empty($data_object->attr_title) ? $data_object->attr_title : '';
    $atts['target'] = !empty($data_object->target) ? $data_object->target : '';
    $atts['rel']    = !empty($data_object->xfn) ? $data_object->xfn : '';
    $atts['href']   = !empty($data_object->url) ? $data_object->url : '';

    $atts = apply_filters('nav_menu_link_attributes', $atts, $data_object, $args, $depth);

    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $nav_icon = get_post_meta($data_object->ID, 'menu_icon', true);
    if (!empty($nav_icon)) {
      $data_object->title = '<i class="' . $nav_icon . ' me-1"></i>' . $data_object->title;
    }

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $data_object->title, $data_object->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $data_object, $depth, $args);
  }

  public function end_el(&$output, $item, $depth = 0, $args = array())
  {
    $output .= "</li>\n";
  }

  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];

    if (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }

    return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }

  public static function fallback($args)
  {
    extract($args);

    $fb_output = null;

    if ($container) {
      $fb_output = '<' . $container;

      if ($container_id) {
        $fb_output .= ' id="' . $container_id . '"';
      }

      if ($container_class) {
        $fb_output .= ' class="' . $container_class . '"';
      }

      $fb_output .= '>';
    }

    $fb_output .= '<ul';

    if ($menu_id) {
      $fb_output .= ' id="' . $menu_id . '"';
    }

    if ($menu_class) {
      $fb_output .= ' class="' . $menu_class . '"';
    }

    $fb_output .= '>';
    $fb_output .= '<li class="menu-item"><a href="' . esc_url(admin_url('nav-menus.php')) . '">Add Menus</a></li>';
    $fb_output .= '</ul>';

    if ($container) {
      $fb_output .= '</' . $container . '>';
    }

    echo wp_kses($fb_output, array(
      'ul'   => array('id' => array(), 'class' => array()),
      'li'   => array('class' => array()),
      'a'    => array('href' => array()),
      'span' => array(),
    ));
  }
}
