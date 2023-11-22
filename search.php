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

<section>
  <?php get_template_part('template-parts/components/hero-header'); ?>

  <div class="ca-container my-8 ca-page-flex">
    <div class="w-full">
      <?php if ($posts->have_posts()) : ?>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
          <?php while ($posts->have_posts()) : $posts->the_post(); ?>
            <?php get_template_part('template-parts/loop/grid-readmore') ?>
          <?php endwhile; ?>
        <?php else : ?>
          <?php get_template_part('template-parts/loop/item-none'); ?>
        </ul>
      <?php endif; ?>
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
