<?php

/**
 * Template Name: Portfolio
 * Description: A Page Template that adds a sidebar to pages
 */

$portfolio = _capalot('portfolio', []);

get_header(); ?>

<section class="px-2 py-8">
  <ul id="masonry-container">
    <?php foreach ($portfolio as $item) : ?>
      <li class="item mb-2 relative md:w-[30rem] bg-primary p-1 rounded-md group mx-auto">
        <img src="<?= $item['_img'] ?>" alt="<?php echo $item['_title'] ?>">
        <a class="absolute top-0 left-0 right-0 rounded-md bottom-0 hidden group-hover:flex group-hover:bg-primary-hover flex-col px-2 text-center items-center justify-center" href="<?php echo $item['_url']; ?>">
          <h3><?php echo $item['_title']; ?></h3>
          <p class="mt-2"><?php echo $item['_desc']; ?></p>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

<script src="<?= get_template_directory_uri(); ?>/assets/js/masonry.min.js"></script>
<script>
  $(document).ready(function() {
    // 初始化 Masonry
    var $masonryContainer = $('#masonry-container');
    $masonryContainer.masonry({
      itemSelector: '.item',
      columnWidth: 70,
      percentPosition: true,
    });
  });
</script>
<?php get_footer();
