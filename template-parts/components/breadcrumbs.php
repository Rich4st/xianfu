<div class="my-2 relative">
  <a class="text-2xl hidden md:inline-block align-middle p-2 border rounded-full dark:border-gray-700 mr-2 hover:bg-primary-hover hover:text-white duration-300 absolute -left-16" href="javascript:history.go(-1)" title="返回" aria-label="返回">
    <i class="iconify" data-icon="ic:baseline-keyboard-arrow-left"></i>
  </a>
  <?php
  $categories = get_the_category($post_id);
  if ($categories) :
    foreach ($categories as $category) : ?>
      <a class="link" href="<?php echo get_category_link($category->term_id); ?>" class="text-gray-500 hover:text-gray-700">
        <?php echo $category->name; ?>
      </a>
  <?php endforeach;
  endif; ?>
</div>
