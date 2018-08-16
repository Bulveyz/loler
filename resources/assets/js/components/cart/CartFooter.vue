<template>
    <!-- Cart Footer -->
    <div class="d-flex justify-content-between">
        <h5 class="mt-2">Total: {{total}}$</h5>
        <b-btn>Check out all</b-btn>
    </div>
    <!-- End Cart Footer -->
</template>

<script>
  export default {
    props: {
      total: {
        type: Number,
        required: true
      }
    }
  }
</script>

<style scoped>

</style>