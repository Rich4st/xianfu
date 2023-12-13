<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head() ?>
  <meta name="shenma-site-verification" content="92c25166fdc405fef9ace70831431779_1700898736" />
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-C6CEMD4NQM"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-C6CEMD4NQM');
  </script>
</head>

<body class="dark:bg-dark">

  <?php get_template_part('template-parts/header/header') ?>

  <main class="mx-auto max-w-[92rem]">
