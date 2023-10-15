<div class="flex items-center space-x-2 bg-[#4a4541] w-fit px-2 py-1 rounded-full">
  <button id="decrement" class=" text-white font-semibold px-2 py-1 rounded">-</button>
  <input id="count" type="number" class="bg-[#4a4541] text-xl text-white font-semibold w-16 text-center" value="1">
  <button id="increment" class=" text-white font-semibold px-2 py-1 rounded">+</button>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const countInput = document.getElementById("count");
    const incrementButton = document.getElementById("increment");
    const decrementButton = document.getElementById("decrement");

    countInput.addEventListener("input", function() {
      // 防止输入非数字字符
      if (!/^\d+$/.test(countInput.value)) {
        countInput.value = countInput.value.replace(/[^\d]/g, "");
      }
    });

    incrementButton.addEventListener("click", function() {
      countInput.value = parseInt(countInput.value) + 1;
    });

    decrementButton.addEventListener("click", function() {
      if (parseInt(countInput.value) > 0) {
        countInput.value = parseInt(countInput.value) - 1;
      }
    });
  });
</script>
