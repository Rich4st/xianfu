<section class="ca-container">
  <?php get_template_part('template-parts/components/breadcrumbs') ?>
  <div class="flex items-center justify-start gap-8">
    <div class="border p-2" style="flex:1;">
      <img src="<?php capalot_get_thumbnail_url(); ?>" alt="">
    </div>
    <div style="flex:1;" class="space-y-4">
      <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
      <h2 class="p-8 text-red-500 font-bold bg-gray-100">价格面议</h2>
      <ul class="flex items-center gap-4">
        <li class="p-1.5 text-sky-500 bg-sky-100">专业团队</li>
        <li class="p-1.5 text-sky-500 bg-sky-100">全国可办</li>
        <li class="p-1.5 text-sky-500 bg-sky-100">价格透明</li>
      </ul>
      <button class="px-8 py-2 bg-[#005cde] text-white">立即联系</button>
    </div>
  </div>
  <div class="bg-gray-100 mt-8 border">
    <p class="border-t-4 border-blue-700 bg-white w-fit p-4 px-16">产品详情</p>

    <div class="p-4 bg-white">
      <?php the_content(); ?>
    </div>
  </div>
  <div class="mt-8">
    <h2>相关推荐</h2>


    <?php get_template_part('template-parts/single/related-posts') ?>
  </div>
</section>
