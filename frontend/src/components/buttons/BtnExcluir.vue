<template>
  <v-btn 
  @click="$emit('excluir')">
<v-icon> mdi-delete-forever-outline </v-icon>EXCLUIR</v-btn>
</template>
<style scoped>
.v-btn {
  height: 36px;
  min-width: 64px;
  padding: 0 16px;
  background-color: #eeeeee !important;
}
</style>