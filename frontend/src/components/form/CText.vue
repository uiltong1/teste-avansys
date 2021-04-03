<template>
  <v-text-field
    outlined
    v-bind="$attrs"
    @change="$emit('change', $event)"
  ></v-text-field>
</template>