<?php

$post_id = get_the_id();

/**
 * @var string $thumbs_ratio 缩略图比例
 * @var array $extra_info    额外信息
 *    - category             分类
 *    - desc                 描述
 *    - footer               底部信息
 * @ var string direction    方向  row | col
 */
extract($args);

if (empty($thumbs_ratio)) {
  $thumbs_ratio = 'ratio-16x9';
}

if (empty($extra_info)) {
  $extra_info = array(
    'desc'
  );
}

if(empty($direction)){
  $direction = 'col';
}

?>

<li class="rounded-md overflow-hidden flex flex-col group md:flex-<?php echo $direction; ?> items-center" >
  <div class="ratio <?php echo esc_attr($thumbs_ratio); ?>">
    <a data-bg="<?php capalot_get_thumbnail_url(); ?>" class="lazy bg-no-repeat bg-cover bg-center h-full" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    </a>
  </div>
  <div class="text-xs space-y-2 w-full text-center group-hover:text-white">


    <a class="block w-full group-hover:bg-[#005cde] mt-2 p-2 bg-[#f8f8f8] text-base font-bold dark:text-gray-100 dark:hover:text-gray-300" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <h4 class="hover:text-primary-hover w-full"><?php the_title(); ?></h4>
    </a>

  </div>
</li>
