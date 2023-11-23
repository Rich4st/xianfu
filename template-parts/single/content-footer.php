<?php

$tags = get_the_tags();

?>

<hr>

<?php if (!empty($tags)) : ?>
  <div class="space-x-2 mb-8">
    <?php foreach ($tags as $key => $tag) : ?>
      <a class="tag no-underline p-2 dark:text-white" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" title="<?php echo esc_attr($tag->name); ?>">
        <?php echo esc_html($tag->name); ?>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<div>
  <?php get_template_part('template-parts/components/contact-list') ?>
</div>
