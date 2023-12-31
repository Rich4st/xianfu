<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $title           标题
 * @var string $bg_color        背景色
 * @var array $data             数据
 *    @var string $_img         图片
 *    @var string $_tile        标题
 *    @var string $_content     内容
 * @var boolean $is_show_button 是否显示按钮
 *
 * @var string $button_title    按钮标题
 * @var string $button_href     按钮链接
 */
extract($args);

?>

<section class="dark:bg-dark py-8" style="background-color: <?php echo $bg_color; ?>;">
  <div class="ca-container">
    <h2 class="text-center mb-8">
      <?php echo $title ?? '服务'; ?>
    </h2>
    <ul class="text-gray-700 grid grid-cols-1 md:grid-cols-2 md:gap-4 lg: gap-10">
      <?php if ($data)
        foreach ($data as $item) :
      ?>
        <li>
          <div class="flex items-center">
            <div class="w-1/3">
              <img src="<?php echo $item['_img']; ?>" alt="<?php echo $item['_title']; ?>" alt="<?php echo $item['_title']; ?>">
            </div>
            <div class="w-2/3 ml-4">
              <h3 class="text-2xl font-bold mb-4">
                <?php echo $item['_title']; ?>
              </h3>
              <p class="text-gray-500 md:w-2/3">
                <?php echo $item['_content']; ?>
              </p>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php if ($is_show_button) : ?>
      <button class="btn text-lg font-semibold px-8 py-3 group flex items-center mx-auto mt-4">
        <a aria-label="<?php echo $button_text; ?>" href="<?php echo $button_href; ?>">
          <?php echo $button_text; ?>
        </a>
        <i class="iconify ml-2 group-hover:translate-x-1 duration-300" data-icon="ri:arrow-right-line"></i>
      </button>
    <?php endif; ?>
  </div>
</section>
