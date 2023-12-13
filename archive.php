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

$posts = new WP_Query($query_args);

?>

<section>
  <div class="ca-container my-8 ca-page-flex">

    <div class="w-full">
      <h2>认证回答</h2>

      <?php if ($posts->have_posts()) : ?>
        <ul>
          <?php
          while ($posts->have_posts()) : $posts->the_post(); ?>
            <li class="py-8 border-b">
              <a href="<?php echo the_permalink(); ?>">
                <h3 class="py-4 font-bold"><?php the_title(); ?></h3>
                <span>
                  <?php capalot_post_excerpt(999) ?>
                </span>
              </a>
            </li>
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
  </div>
</section>

<?php get_footer(); ?>
