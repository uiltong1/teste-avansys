<template>
  <v-btn 
  rounded 
  @click="$emit('novo')">
<v-icon> mdi-plus </v-icon>NOVO</v-btn>
</template>
<style scoped>
.v-btn{
    height: 36px;
    min-width: 64px;
    padding: 0 16px;
    background-color: #EEEEEE !important;
    border: solid 1px white;
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.1);
}
</style>