<?php

if (empty($args)) { ?>

  <h2>请正确配置组件</h2>

<?php
  exit;
}

/**
 * @var string $img   照片
 * @var string $name  姓名
 * @var string $info  作者介绍
 *
 */
extract($args);

?>

<section class="my-12">
  <div class="flex flex-col items-center justify-center md:justify-start">
    <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden">
      <img src="<?php echo $img; ?>" alt="头像" class="w-full h-full object-cover">
    </div>
    <div>
      <p class="text-gray-900 dark:text-gray-100 text-lg font-bold">
        <?php echo $name; ?>
      </p>
      <p class="text-gray-500 dark:text-gray-400 text-sm mt-2"><?php echo $info; ?></p>
    </div>
  </div>
</section>
