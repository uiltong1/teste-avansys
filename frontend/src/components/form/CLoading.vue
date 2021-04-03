<template>
  <div  class="loading">
    <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
    ></v-progress-circular>
  </div>
</template>
<style scoped>
.loading {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}
</style>