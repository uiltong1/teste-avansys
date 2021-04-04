<template>
  <v-dialog class="popup" persistent max-width="600" v-model="visualize">
    <v-card class="dialog">
      <v-card-title class="title"
        >TEM CERTEZA QUE DESEJA DESATIVAR ESTE(S) ITEM/ITEMS?</v-card-title
      >
      <v-card-text class="text"
        >Ao desativar este(s) item(itens) você só poderá consulta-lo, mas não poderá mais
        reativar-lo</v-card-text
      >
      <v-card-actions style="display: flex; justify-content: center; align-items: center">
        <v-btn class="btn-nao" @click="$emit('nao', false)"> Não </v-btn>
        <v-btn class="btn-sim" @click="$emit('sim')"> Sim </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  props: ["visualize"],
};
</script>
<style scoped>
.popup {
  background-color: blue;
}
.v-btn:not(.v-btn--round).v-size--default {
  height: 36px;
  width: 150px !important;
  min-width: 64px;
  padding: 0 16px;
  border-radius: 50px;
  font-weight: 300;
}

.btn-sim {
  background-color: #f39c12 !important;
  border: solid 1px #ffffff;
  color: #ffffff !important;
}

.dialog.v-card.v-sheet.theme--light {
  background-color: #fff9c3;
  border: solid 2px #f39c12;
  padding: 20px;
}

.v-card__title.title {
  font-size: 16px !important;
  color: #f39c12;
}

.v-card__text.text {
  color: #f39c12 !important;
}
</style>
