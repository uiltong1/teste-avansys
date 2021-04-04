<template>
  <v-text-field
    outlined
    v-bind="$attrs"
    @change="$emit('change', $event)"
  ></v-text-field>
</template>

<style>
.v-text-field--filled > .v-input__control > .v-input__slot,
.v-text-field--full-width > .v-input__control > .v-input__slot,
.v-text-field--outlined > .v-input__control > .v-input__slot {
  min-height: 30px !important;
}
</style>