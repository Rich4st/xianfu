<?php

get_header()
?>

<main>
  <section class="ca-container pb-8">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>
