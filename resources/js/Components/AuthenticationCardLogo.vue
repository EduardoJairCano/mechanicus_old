<template>
  <inertia-link :href="'/'">
    <img class="w-60" :src="image" alt="Logo mechanicus">
  </inertia-link>
</template>

<script>
  import image from '../../image/mechanicus-example.png'

  export default {
    data() {
      return {
        image: image
      }
    }
  }
</script>
