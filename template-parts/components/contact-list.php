<?php

$icon_map = [
  'is_wx'     => 'ri:wechat-fill',
  'is_qq'     => 'ri:qq-fill',
  'is_email'  => 'carbon:email',
  'is_phone'  => 'ri:phone-fill',
  'is_x'      => 'ri:twitter-x-line',
  'is_fb'     => 'logos:facebook',
  'is_ins'    => 'skill-icons:instagram',
];

$list = _capalot('contact_list');

$contact_list = [];
$tempArray = [];

foreach ($list[0] as $key => $value) {
  $tempArray[$key] = $value;

  if (count($tempArray) == 2) {
    $contact_list[] = $tempArray;
    $tempArray = [];
  }
}

if (!empty($tempArray)) {
  $contact_list[] = $tempArray;
}

$foundTrue = false;
foreach ($contact_list as $subArray) {
  $firstElementValue = reset($subArray);

  if ($firstElementValue === "1") {
    $foundTrue = true;
    break; // 找到true后立即退出循环
  }
}

?>

<?php if ($foundTrue) : ?>
  <div class="flex items-center gap-2">
    <?php foreach ($contact_list as $i) :
      if (reset($i) === "" || reset($i) === '0') continue;

      $icon_key = key($i);
      $color = '';
      if (key($i) === 'is_wx') $color = 'text-green-500';

      next($i);

      if (is_array(current($i))) {
        $values = array_values(current($i));

        $html = "<img class='w-48' src='$values[0]' />
        <div class='flex items-center justify-around'>
          <span class='copy-text'>$values[1]</span>
          <button role='button' id='copy-btn' aria-label='复制到剪切板'>
            <i class='iconify inline-block text-2xl' data-icon='line-md:clipboard-arrow-twotone'></i>
          </button>
        </div>";
    ?>
        <i class="iconify text-3xl <?php echo $color; ?> popper-button" data-icon="<?php echo $icon_map[$icon_key]; ?>" data-content="<?php echo $html; ?>" data-show="copyText"></i>
      <?php
      } else { ?>
        <a href="<?php echo current($i); ?>" aria-label="社媒链接">
          <i class="iconify text-3xl popper-button" data-content="去我主页看看" data-icon="<?php echo $icon_map[$icon_key]; ?>"></i>
        </a>
      <?php } ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
