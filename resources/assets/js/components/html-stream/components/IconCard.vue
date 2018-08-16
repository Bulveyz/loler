<template>
    <div class="u-icon-block__col">
    <span :class="['u-icon mb-4', 'u-icon--size--' + uIconSize, 'u-icon-' + variant, rounded]">
        <slot></slot>
    </span>
        <h3 class="h5">{{title}}</h3>
        <p class="mb-0">{{subtitle}}</p>
    </div>
</template>
<script>
  export default {
    name: "IconCard",
    props: {
      title: String,
      subtitle: String,
      uIconSize: {
        default: 'xl'
      },
      variant: {
        default: 'primary'
      },
      rounded: {
        default: 'rounded-circle'
      }
    }
  }
</script>

<style scoped>

</style>