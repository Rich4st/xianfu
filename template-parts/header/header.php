<?php

$current_theme = capalot_get_site_theme();

if ($current_theme === 'light') {
  $button_label = '切换为暗色模式';
} else {
  $button_label = '切换为亮色模式';
}

/**
 * @var string $fixed 固定在顶部
 *
 */
extract($args);

?>

<header class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-dark shadow-[0_2px_10px_0_rgba(36,50,66,0.075)]">
  <div class="ca-container h-20 dark:text-gray-100 flex items-center justify-between">
    <div class="flex items-center">
      <div class="pr-10 dark:border-gray-700">
        <?php
        $site_logo = _capalot('site_logo');
        $site_name = get_bloginfo('name');

        if (!empty($site_logo)) {
          $logo_html = sprintf('<img class="h-10 w-10 rounded-full" src="%s" alt="%s">', esc_url($site_logo), esc_attr($site_name));
        } else {
          $logo_html = sprintf('<span class="text-2xl font-bold">%s</span>', esc_html($site_name));
        }

        printf('<a rel="nofollow noopener noreferrer" href="%s" aria-label="%s">%s</a>', esc_url(home_url('/')), $site_name, $logo_html);
        ?>
      </div>

      <nav class="main-menu navbar hidden lg:block z-[999]">
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
    <div class="flex items-center space-x-4">
      <button role="button" aria-label="<?php echo $button_label; ?>" class="toggle-dark rounded-full border hover:border-gray-400 dark:border-gray-700 dark:hover:border-gray-500 transition-all duration-300 px-4 py-1 relative">
        <i class="iconify relative -right-2.5 <?php echo $current_theme === 'light' ? 'hidden' : '' ?>" data-icon="carbon:moon"></i>
        <i class="iconify relative -left-2.5 <?php echo $current_theme === 'dark' ? 'hidden' : '' ?>" data-icon="solar:sun-bold-duotone"></i>
      </button>
      <i id="menu-icon" class="iconify text-2xl md:hidden" data-icon="ri:menu-line"></i>
    </div>

    <?php get_template_part('template-parts/header/side-menu', '', ''); ?>
  </div>
</header>
