<template>
  <v-container>
    <div class="title">
      <h2>MANTER OPERADORA</h2>
    </div>
    <v-card>
      <v-container>
        <v-row>
          <v-col md="3">
            <v-row>
              <v-col>
                <c-select
                  label="Listar"
                  :items="campos.operadoras"
                  item-text="no_operadora"
                  item-value="id"
                  :value="data.id"
                  @change="changeOperadora($event)"
                ></c-select>
              </v-col>
            </v-row>
          </v-col>
          <v-col md="3">
            <v-row>
              <v-col>
                <c-select
                  label="Status"
                  :items="campos.status"
                  item-text="no_status"
                  item-value="id"
                  v-model="data.id_status"
                  @change="changeStatus($event)"
                ></c-select>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
        <c-loading v-if="loading"></c-loading>
        <c-table
          v-else
          :items="operadoras"
          :inativo="data.id_status"
          @salvar="salvar($event)"
          @toggle="toggle($event)"
          @excluir="excluir($event)"
        />
      </v-container>
    </v-card>
  </v-container>
</template>
<script>
import OperadoraServices from "../../services/OperadoraServices";
import OperadorasServices from "../../services/OperadoraServices";
export default {
  data() {
    return {
      operadoras: [],
      campos: {},
      data: {},
      loading: false,
    };
  },
  async created() {
    const result = await OperadorasServices.get();
    this.loading = false;
    this.operadoras = result.data.data.operadoras;
    this.campos = result.data.data.campos;
  },
  methods: {
    async search() {
      const result = await OperadorasServices.search(this.data);
      this.operadoras = result.data;
    },
    async changeOperadora(event) {
      this.data.id = event;
      this.search();
    },
    async changeStatus(event) {
      this.data.id_status = event;
      this.search();
    },
    async salvar(item) {
      var result;
      if (item.id) {
        result = await OperadorasServices.update(item.id, item);
        console.log(result);
      } else {
        result = await OperadoraServices.post(item);
        console.log(result);
      }
    },
    async excluir(item) {
      var result;
      result = await OperadoraServices.delete(item);
      console.log(result);
    },
    async toggle(item) {
      console.lof(item);
    },
  },
};
</script>

<style scoped>
.title {
  margin-top: 20px;
  margin-bottom: 40px;
  border-bottom: solid 1px black;
}
.title h2 {
  font-weight: 300 !important;
}
</style>