<template>
  <v-container>
    <c-delete :visualize="exclusao" @nao="exclusao = $event" @yes="deletar(null)" />
    <c-toggle :visualize="alteracao" @nao="nao()" @sim="update(null)" />
    <div class="title">
      <h2>MANTER OPERADORA</h2>
    </div>
    <v-alert v-if="alert" :type="alert.type">{{ alert.message }}</v-alert>
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
          @update="update($event)"
          @salvar="salvar($event)"
          @toggle="update($event)"
          @excluir="deletar($event)"
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
      exclusao: false,
      alteracao: false,
      item: null,
      alert: null,
    };
  },
  async created() {
    this.showIndex();
  },
  watch: {
    alert() {
      setTimeout(() => {
        this.alert = null;
      }, 4000);
    },
  },
  methods: {
    update(item = null) {
      if (item) {
        this.item = item;
        if (!this.alteracao) this.alteracao = true;
        else this.alteracao = false;
      } else if (item === null) {
        if (!this.item.operadora) this.toggle(this.item);
        else this.salvar(this.item);
        this.item = null;
        this.alteracao = false;
      }
    },

    deletar(item = null) {
      if (item) {
        this.item = item;
        if (!this.exclusao) this.exclusao = true;
        else this.exclusao = false;
      } else if (item === null) {
        this.exclusao = false;
        this.excluir(this.item);
        this.item = null;
      }
    },

    nao() {
      if (this.item.no_operadora) {
        this.showIndex();
      }
      this.item = null;
      this.exclusao = null;
      this.alteracao = null;
    },

    async showIndex() {
      const result = await OperadorasServices.get();
      this.loading = false;
      this.operadoras = result.data.data.operadoras;
      this.campos = result.data.data.campos;
    },

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
      if (item.id) {
        await OperadorasServices.update(item.id, item)
          .then((result) => {
            this.checkResponse(result);
            this.showIndex();
          })
          .catch((error) => {
            this.checkResponse(error.response);
          });
      } else {
        await OperadoraServices.post(item)
          .then((result) => {
            this.checkResponse(result);
            this.showIndex();
          })
          .catch((error) => {
            this.checkResponse(error.response);
          });
      }
    },

    async excluir(item) {
      var request = { operadoras: item };
      await OperadoraServices.delete(request)
        .then((result) => {
          this.checkResponse(result);
          this.showIndex();
        })
        .catch((error) => {
          this.checkResponse(error.response);
        });
      this.showIndex();
    },

    async toggle(item) {
      var request = { operadoras: item };
      await OperadorasServices.toggle(request)
        .then((result) => {
          this.checkResponse(result);
          this.showIndex();
        })
        .catch((error) => {
          this.checkResponse(error.response);
        });
    },

    checkResponse(response) {
      switch (response.status) {
        case 200:
          if (!response.data.message) response.data.message = "OK";
          this.alert = {};
          this.alert.message = response.data.message;
          this.alert.type = "success";
          break;

        case 412:
          this.alert = {};
          this.alert.message = response.data.message;
          this.alert.type = "error";
          break;
      }
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
