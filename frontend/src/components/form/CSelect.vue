<template>
  <v-select
    outlined
    no-data-text="Sem dados"
    v-bind="$attrs"
    @change="$emit('change', $event)"
  ></v-select>
</template>