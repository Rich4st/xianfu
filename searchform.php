<div id="search-form" class="my-4">
  <form class="relative" method="get" action="<?php echo esc_url(home_url('/')); ?>">

    <input type="text" class="dark:bg-dark dark:text-gray-400 px-2 py-3 text-lg font-semibold pr-2 w-full outline-none ring-2 focus:ring-pink-500 active:ring-pink-500" placeholder="搜索..." autocomplete="off" value="<?php echo esc_attr(get_search_query()) ?>" name="s" required="required">

    <button title="点击搜索" type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 hover:bg-gray-200 dark:hover:bg-gray-800 p-2.5 rounded-full duration-300">
      <i class="iconify text-lg dark:text-gray-400" data-icon="mingcute:search-line"></i>
    </button>
  </form>
</div>
