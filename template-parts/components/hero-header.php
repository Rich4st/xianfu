<?php

/**
 * Hero Header
 *
 * @param string $title        标题
 * @param string $description  描述
 */
extract($args);

?>

<div class="bg-primary dark:bg-dark text-center py-12 text-white">
  <h1 class="font-semibold text-white mb-2">
    <?php
    if (!is_search()) {
      echo $title;
    } elseif (have_posts()) {
      $total_results = $wp_query->found_posts;
      echo "找到 {$total_results} 个符合 '<strong>" . get_search_query() . "</strong>' 的搜索结果。";
    }
    ?>
  </h1>
  <p>
    <?php echo $description ?? ''; ?>
  </p>
</div>
