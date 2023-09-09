<template>
  <button
    type="button"
    data-bs-target="#promotionControls"
    :data-bs-slide-to="index"
    :class="{'active': index === 0}"
    :aria-current="index === 0 ? 'true' : ''"
    :aria-label="'Slide ' + (index + 1)">
  ></button>
</template>

<script>
export default {
  props: {
    index: Number,
  }
};
</script>
