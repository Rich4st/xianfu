<?php

/**
 * Template Name: Contact
 */

get_header();
?>

<main class="pb-8">
  <div class="relative mb-10">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact-us.webp" class="w-full h-96 object-cover" alt="联系我们背景图">
    <div class="absolute inset-0 bg-black bg-opacity-50 z-40"></div>
    <div class="absolute z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center">
      <h1 class="text-white dark:text-gray-200 mb-4">联系我们</h1>
      <p class="text-white dark:text-gray-200">需要专家为您服务吗？如果有网站建置、网站代管、技术服务、业务合作，都欢迎与我们联系！</p>
    </div>

    <a href="#contact" title="联系我们" aria-label="联系我们">
      <i id="contact" class="iconify z-40 absolute bottom-2 left-1/2 -translate-x-1/2 rounded-full hover:opacity-80 font-thin text-white p-2 ca-border text-4xl animate-bounce" data-icon="icon-park-outline:arrow-down"></i>
    </a>
  </div>
  <div class="ca-container flex gap-8 md:gap-16 flex-col md:flex-row">
    <div style="flex: 1;" class="ca-border rounded-xl py-10 px-8">
      <h2 class="mb-8">服务咨询</h2>

      <form action="">
        <div class="mb-4">
          <label for="name" class="dark:text-gray-500 mb-2">姓名<span class="text-red-500">*</span></label>
          <input type="text" id="name" class="input " placeholder="请输入您的姓名" required>
        </div>
        <div class="mb-4">
          <label for="email" class="dark:text-gray-500 mb-2">邮箱<span class="text-red-500">*</span></label>
          <input type="email" id="email" class="input" placeholder="请输入您的邮箱" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="dark:text-gray-500 mb-2">电话<span class="text-red-500">*</span></label>
          <input type="tel" id="phone" class="input" placeholder="请输入您的电话" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="dark:text-gray-500 mb-2">您的需求<span class="text-red-500">*</span></label>
          <ul class="flex items-center mb-2 space-x-2">
            <li>
              <input type="checkbox" id="build" class="w-6 h-6 align-bottom">
              <label for="build">网站搭建</label>
            </li>
            <li>
              <input type="checkbox" id="manager" class="w-6 h-6 align-bottom">
              <label for="manager">网站代管</label>
            </li>
            <li>
              <input type="checkbox" id="tech" class="w-6 h-6 align-bottom">
              <label for="tech">技术服务</label>
            </li>
            <li>
              <input type="checkbox" id="cooperation" class="w-6 h-6 align-bottom">
              <label for="cooperation">业务合作</label>
            </li>
            <li>
              <input type="checkbox" id="others" class="w-6 h-6 align-bottom">
              <label for="others">其他</label>
            </li>
          </ul>

        </div>
        <div class="mb-4">
          <label for="message" class="dark:text-gray-500 mb-2">留言</label>
          <textarea name="message" id="message" cols="30" rows="4" class="input" placeholder="请输入您的留言"></textarea>
        </div>
        <div class="mb-4">
          <button type="submit" class="btn-primary px-8 rounded-full">提交</button>
        </div>
      </form>
    </div>
    <div style="flex: 1;" class="pt-8">
      <h3 class="mb-8">更多联络方式</h3>
      <?php get_template_part('template-parts/components/contact-list') ?>

      <hr>

      <h3 class="mb-8">地址</h3>
      <p>福建省厦门</p>
    </div>
  </div>
</main>

<?php get_footer(); ?>
