<?php get_header();

$post_id = get_the_ID();

?>

<main class="max-w-7xl mx-auto">
  <h1 class="text-3xl font-bold text-white bg-pink-500 text-center">
    <?php echo the_title(); ?>
  </h1>

  <div class="grid md:grid-cols-3 md:gap-8 mt-4">
    <div>
      <?php get_template_part('template-parts/components/thumbs-gallery') ?>
    </div>
    <div class="space-y-2">
      <h3 class="text-2xl">
        <?php capalot_post_category(); ?>
      </h3>
      <div class="space-x-2"><?php capalot_get_post_tags(); ?></div>
      <h2 class="text-4xl font-semibold text-pink-500 pb-2 border-b"><?php echo the_title(); ?></h2>
      <p><?php capalot_post_excerpt(999); ?></p>
    </div>
    <div>
      <div class="space-y-2">
        <p> <?php capalot_post_category(); ?> </p>
        <p class="font-semibold"><?php echo the_title(); ?></p>
        <p class="text-2xl font-bold text-red-400 mb-2 pb-2 border-b">
          ￥<?php capalot_get_product_price($post_id) ?>
        </p>
      </div>
      <ul class=" list-disc space-y-3">
        <li class="ml-5">
          <p><strong class="text-green-500">存货充足</strong>，免运费险</p>
        </li>
        <li class="flex items-center space-x-4">
          <?php get_template_part('template-parts/components/counter') ?>
          <button class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full">加入购物车</button>
        </li>
        <li class="ml-5">
          <p class="font-bold">查看库存</p>
        </li>
      </ul>
    </div>


</main>

<?php get_footer(); ?>
