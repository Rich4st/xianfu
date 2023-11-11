<?php

?>

<div class="list-none text-primary text-base">
  <span>
    <?php echo get_the_date('Y-m-d'); ?>
  </span>
  <span>
    <a class="link" href="<?php echo get_permalink(); ?>#comments">
      <?php
      $comments_count = get_comments_number();
      if ($comments_count > 0) {
        echo $comments_count . ' 条评论';
      } else {
        echo '暂无评论';
      }
      ?>
    </a>
  </span>
</div>
