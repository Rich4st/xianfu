<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 设置浏览器缓存为一小时 -->
  <meta http-equiv="Cache-Control" content="max-age=3600">
  <title>xianfu</title>
  <meta name="description" content="xianfu">
  <meta name="keywords" content="xianfu">
  <?php wp_head() ?>
</head>

<body class="dark:bg-dark">

  <button class="p-2 bg-sky-400 rounded-full toggle-dark fixed z-50">
    Dark mode
  </button>
  <header class="h-16 border-b mb-8 flex items-center justify-center">
    <a class="text-3xl font-bold block" href="<?php echo home_url(); ?>">
      Home
    </a>
  </header>
