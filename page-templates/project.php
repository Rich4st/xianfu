<?php
/* Template Name: Project */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
?>

        <main class="ca-container py-8">
            <h1 class="mb-5 text-center">
                <?php the_title(); ?>
            </h1>
            <?php the_content(); ?>
        </main>

<?php
    endwhile;
endif;

get_footer();
?>
