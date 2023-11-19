<?php get_header();

$post_id = get_the_ID();

?>


<section class="dark:bg-dark flex flex-col lg:flex-row md:gap-8 px-4 xl:px-0 justify-center">
  <div class="w-full prose prose-xl prose-p:text-base dark:prose-p:text-gray-400 prose-h1:mb-4 prose-h1:text-2xl md:prose-h1:text-4xl xl:prose-h1:text-5xl prose-li:text-basedark:text-gray-400">
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
    <?php get_template_part('template-parts/single/post-info') ?>

    <?php get_template_part('template-parts/single/content-menu') ?>
    <?php get_template_part('template-parts/single/content-menu', '', [
      'fixed' => true,
    ]) ?>

    <div>
      <?php echo the_content(); ?>
    </div>

    <?php get_template_part('template-parts/single/post-navigation') ?>

    <?= comments_template(); ?>

  </div>
  <div id="sidebar" class="md:max-w-[18rem] pt-20">
    <?php get_search_form(); ?>
    <?php dynamic_sidebar('single-sidebar'); ?>
  </div>
</section>

<?php get_template_part('template-parts/single/related-posts', '', [$post_id]) ?>

<?php get_footer(); ?>
