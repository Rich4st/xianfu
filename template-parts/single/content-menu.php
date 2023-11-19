<?php

$content = get_the_content();

// 获取所有heading2的内容
preg_match_all('/<h(\d)[^>]*>(.*?)<\/h\1>/i', $content, $matches, PREG_SET_ORDER);

$index = 1;
$subindex = 1;

extract($args);

if ($fixed) {
  $fixed_menu = 'fixed top-16 right-0 xl:right-[15vw] md:block';
}

?>

<div class="w-fit border dark:border-gray-700 p-2 mt-4 z-50 bg-white dark:bg-dark-card <?php echo $fixed_menu; ?>">
  <div class="flex items-center justify-between font-bold">
    <div>
      <i class="iconify text-4xl inline-block align-bottom" data-icon="system-uicons:side-menu"></i>
      <span>目录</span>
    </div>
    <i id="content-menu-btn" class="iconify text-4xl p-0.5 hover:bg-primary-hover hover:text-white duration-300 rounded-full cursor-pointer" data-icon="mingcute:down-line"></i>
  </div>
  <ul id="content-menu-body" class="py-0 <?php if ($fixed) echo 'hidden' ?>">
    <?php foreach ($matches as $key => $match) :
    ?>
      <li>
        <?php if ($match[1] == 2) : ?>
          <a class="link" href="#<?php echo $match[2]; ?>">
            <?php echo $index . '. ' . $match[2]; ?>
          </a>
        <?php
          $index++;
          $subindex = 1;
        else :
        ?>
          <a class="ml-4 text-base link" href="#<?php echo $match[2]; ?>">
            <?php echo ($index - 1) . '.' . $subindex . $match[2]; ?>
          </a>
        <?php
          $subindex++;
        endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
