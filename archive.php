<?php get_header();

$term = get_queried_object();

$page = isset($_GET['page']) ? absint($_GET['page']) : 1;
$limit = 10;

$is_tag_page = is_tag();

$query_args = array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'paged'           => $page,
  'posts_per_page'  => $limit,
  'orderby'         => 'date',
  'order'           => 'DESC',
);

if ($term && !$is_tag_page) {
  $query_args['category__in'] = $term->term_id;
} else if ($is_tag_page) {
  $query_args['tag'] = $term->slug; // 使用标签的slug
}

$posts = new WP_Query($query_args);

?>

<section>
  <?php
  if ($is_tag_page)
    $title = '标签: ' . $term->name;
  else
    $title = '分类: ' . $term->name;

  get_template_part('template-parts/components/hero-header', '', [
    'title' => $title,
    'description' => $term->description,
  ]);
  ?>
  <div class="ca-container my-8 ca-page-flex">
    <div class="w-full">
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
        get_template_part('template-parts/loop/item-none');
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
