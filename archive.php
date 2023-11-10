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
  <div class="bg-gray-700">
    <h1 class="text-center py-10 font-semibold text-white dark:text-gray-900">
      <?php
      if ($category) {
        echo '分类: ' . $category->name;
      }
      ?>
    </h1>
  </div>
  <div class="xf-container my-8 flex flex-col md:flex-row justify-around">
    <div>
      <?php if ($posts->have_posts()) : ?>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-8">
          <?php
          while ($posts->have_posts()) : $posts->the_post(); ?>
            <?php get_template_part('template-parts/loop/grid') ?>
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
    <div>
      <?php get_search_form(); ?>
      <?php get_template_part('template-parts/widget/side/latest-post') ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
