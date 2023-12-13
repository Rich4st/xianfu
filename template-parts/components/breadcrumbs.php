<div class="my-2 relative py-8">
  <span>您现在的位置：</span>
  <a class="no-underline" href="<?php echo home_url(); ?>" class="text-gray-500 hover:text-gray-700">
    首页 >
  </a>
  <a class="no-underline" href="<?php echo home_url(); ?>" class="text-gray-500 hover:text-gray-700">
    <?php
    if (is_single())
      echo '认证回答';
    else
      echo '认证服务';
    ?> >
  </a>
  <?php
  $categories = get_the_category($post_id);
  if ($categories) :
    foreach ($categories as $category) : ?>
      <a class="no-underline" href="/" class="text-gray-500 hover:text-gray-700">
        <?php the_title(); ?>
      </a>
  <?php endforeach;
  endif; ?>
</div>
