<?php get_header();

$category = get_queried_object();

$page = isset($_GET['page']) ? absint($_GET['page']) : 1;
$limit = 10;

$query_args = array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'paged'           => $page,
  'posts_per_page'  => $limit,
  'category__in'    => $category->term_id,
  'orderby'         => 'date',
  'order'           => 'DESC',
);

$posts = new WP_Query($query_args);

?>

<section>
  <div class="bg-primary dark:bg-dark text-center py-12 text-white">
    <h1 class="font-semibold text-white">
      <?php
      if ($category)
        echo '分类: ' . $category->name;
      ?>
    </h1>
    <p class="mt-2">
      <?php
      if ($category)
        echo $category->description;
      ?>
    </p>
  </div>
  <div class="ca-container my-8 ca-page-flex">
    <div>
      <?php if ($posts->have_posts()) : ?>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 lg:gap-4">
          <?php
          while ($posts->have_posts()) : $posts->the_post(); ?>
            <?php get_template_part('template-parts/loop/grid-readmore') ?>
          <?php endwhile; ?>
        </ul>
      <?php
        wp_reset_postdata();
        capalot_pagination($page, $posts->max_num_pages);
      else :
        get_template_part('template-parts/content/none');
      endif;
      ?>
    </div>
    <div class="sm:max-w-xs">
      <?php get_search_form();
      dynamic_sidebar('page-sidebar');
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
