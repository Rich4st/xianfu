<?php get_header();

$post_id = get_the_ID();

?>

<section class="dark:bg-dark flex flex-col lg:flex-row md:gap-8 px-4 lg:px-0 justify-center">
  <div class="prose prose-xl prose-p:text-base prose-h1:mb-8 prose-li:text-base dark:text-gray-400">
    <div class="my-2">
      <?php
      $categories = get_the_category($post_id);
      if ($categories) :
        foreach ($categories as $category) : ?>
          <a class="link" href="<?php echo get_category_link($category->term_id); ?>" class="text-gray-500 hover:text-gray-700">
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
  <div id="sidebar" class="md:max-w-[18rem] py-20">
    <?php get_search_form(); ?>
    <?php dynamic_sidebar('single-sidebar'); ?>
  </div>
</section>

<?php get_footer(); ?>
