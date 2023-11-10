</main>


<footer class="mt-2 py-4 bg-gray-800 text-white font-semibold">
  <ul class="flex flex-col md:flex-row items-center justify-evenly">
    <li>
      Copyright © 2023
      <a class="primary" href="<?php echo home_url(); ?>" aria-label="">先富网站</a>
      版权所有
    </li>
    <li>
      客服信箱: hi.xianfu@gmail.com
    </li>
    <li>
      <a class="primary" href="">服务条款</a>
      <a class="primary" href="">隐私政策</a>
    </li>
  </ul>
</footer>

<?php get_template_part('template-parts/components/back-to-top') ?>

<script>
  const backToTop = document.querySelector('#back-to-top');

  backToTop.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  });

  window.addEventListener('scroll', () => {
    if (window.scrollY > 80) {
      backToTop.classList.remove('hidden');
    } else {
      backToTop.classList.add('hidden');
    }
  });
</script>


<?php wp_footer(); ?>

</body>

</html>
