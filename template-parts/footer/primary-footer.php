<section class="bg-primary text-gray-200 py-12">
  <ul class="ca-container grid grid-cols-1 lg:grid-cols-3 gap-8 text-center lg:text-left">
    <li>
      <h3 class="mb-2 text-white font-semibold">订阅电子报</h3>
      <p>你也想成为自由工作者吗？我会和你分享心路历程、建站经验、个人品牌、实用工具喔~</p>
    </li>
    <li class="space-y-2">
      <h3 class="text-white font-semibold">关于先富网站</h3>
      <p>长期分享 WordPress 建站教学、SEO 技巧、网络营销，帮你提升行销硬实力，欢迎关注学习！</p>
      <div class="flex justify-center lg:justify-start">
        <?php get_template_part('template-parts/components/contact-list') ?>
      </div>
    </li>
    <li>
      <h3 class="mb-2 text-white font-semibold">其他链接</h3>
      <ul>
        <li>
          <a href="<?php echo home_url(); ?>">隐私政策</a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>">服务条款</a>
        </li>
      </ul>
    </li>
  </ul>
</section>
