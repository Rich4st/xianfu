<?php get_header();

$s    = get_search_query();
$page = isset($_GET['page']) ? absint($_GET['page']) : 1;

$args = array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'posts_per_page'  => 10,
  'paged'           => $page,
  's'               => $s,
  'orderby'         => 'date',
  'order'           => 'DESC',
);

$posts = new WP_Query($args);

?>

<section class="py-8">
  <div class="ca-container ca-page-flex">
    <div>
      <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
        <?php if ($posts->have_posts()) : ?>
          <?php while ($posts->have_posts()) : $posts->the_post(); ?>
            <?php get_template_part('template-parts/loop/grid') ?>
          <?php endwhile; ?>
        <?php else : ?>
          <?php get_template_part('template-parts/loop/item-none'); ?>
        <?php endif; ?>
      </ul>
      <?php wp_reset_postdata();
      capalot_pagination($page, $posts->max_num_pages); ?>
    </div>
    <div class="sm:max-w-xs">
      <?php get_search_form(); ?>
      <?php dynamic_sidebar('page-sidebar'); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
