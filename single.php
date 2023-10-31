<?php get_header();

$post_id = get_the_ID();

?>

<section class="dark:bg-dark xf-container flex flex-col lg:flex-row md:gap-8 px-4 items-center justify-between">
  <div class="prose lg:prose-xl">
    <div class="my-2">
      <?php
      $categories = get_the_category($post_id);
      if ($categories) :
        foreach ($categories as $category) : ?>
          <a href="<?php echo get_category_link($category->term_id); ?>" class="text-gray-500 hover:text-gray-700">
            <?php echo $category->name; ?>
          </a>
      <?php endforeach;
        endif; ?>
    </div>

    <h1><?php echo the_title(); ?></h1>
    <div>
      <?php echo the_content(); ?>
    </div>
  </div>
  <div id="sidebar" class="w-80">
    side bar
  </div>
</section>

<?php get_footer(); ?>
