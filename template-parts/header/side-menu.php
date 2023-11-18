<?php

?>

<div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>
<div id="sidebar" class="bg-white dark:bg-dark w-11/12 max-w-lg h-full fixed top-0 right-0 transform translate-x-full transition-transform duration-300 ease-in-out z-50 dark:text-gray-400">
  <button aria-label="close side-menu" id="closeSidebar" class="p-2 absolute top-4 right-4 bg-opacity-60 hover:bg-primary-hover rounded-full hover:text-white duration-300">
    <i class="iconify" data-icon="pajamas:close"></i>
  </button>

  <div class="pt-16 px-4">
    <nav class="sidebar-main-menu">
      <?php
      $cached_menu = wp_nav_menu(array(
        'container' => true,
        'fallback_cb' => 'Capalot_Walker_Nav_Menu::fallback',
        'menu_id' => 'header-navbar',
        'menu_class' => 'nav-list',
        'theme_location' => 'main-menu',
        'walker' => new Capalot_Walker_Nav_Menu(true),
        'echo' => false, // 返回html内容
      ));
      // 输出菜单
      echo $cached_menu;
      ?>
    </nav>
  </div>
</div>
