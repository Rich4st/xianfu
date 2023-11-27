<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body>

  <?php get_header(); ?>

  <main>
    <button class="btn">
      <a href="<?php echo home_url(); ?>">back</a>
    </button>
    <h1>404</h1>
  </main>

  <?php get_footer(); ?>
</body>

</html>
