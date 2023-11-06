<?php

/**
 * $title 标题
 * $sub_title 副标题
 * $is_background_fixed 是否固定背景
 * $img 背景图片
 * $buttons 按钮
 * $buttons._title 按钮标题
 * $buttons._color 按钮颜色
 * $buttons._href 按钮链接
 */
extract($args);

$bg_style = intval($is_background_fixed) ? 'bg-fixed' : 'bg-scroll';

?>

<section data-bg="<?php echo $img; ?>" class="lazy <?php echo $bg_style; ?> bg-repeat bg-cover py-14 text-center my-8">
  <div>
    <h2 class="dark:text-black">
      <?php echo $title; ?>
    </h2>
    <p class="mt-2 text-white dark:text-gray-400">
      <?php echo $sub_title; ?>
    </p>
  </div>
  <ul class="flex items-center justify-center mt-8 space-x-10">
    <?php foreach ($buttons as $button) : ?>
      <li>
        <a style="background-color: <?php echo $button['_color']; ?>" href="<?php echo $button['_href']; ?>" class="btn px-5 py-2.5 hover:opacity-80">
          <?php echo $button['_title']; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
