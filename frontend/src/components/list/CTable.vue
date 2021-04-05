<template>
  <div>
    <template v-if="inativo != 2">
      <div>
        <btn-novo @novo="novo()"></btn-novo>
      </div>
      <div class="controls">
        <v-checkbox class="control" v-model="check" @change="checkall()"></v-checkbox>
        Marcar Todos
        <btn-excluir class="control" @excluir="actionSelected('excluir')" />
        <btn-toggle class="control" @toggle="actionSelected('toggle')" />
      </div>
    </template>
    <c-loading v-if="loading"></c-loading>
    <v-simple-table v-else>
      <template v-slot:default>
        <thead>
          <tr>
            <td v-if="inativo != 2" style="width: 100px"></td>
            <td>Operadora</td>
            <td>Descrição</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, i) in data" :key="i">
            <template v-if="!item.edit">
              <td class="actions" v-if="inativo != 2">
                <v-checkbox
                  :false-value="2"
                  :true-value="1"
                  v-model="item.check"
                  @change="checkin($event, i)"
                ></v-checkbox>
                <v-icon class="editar" title="Editar" @click="edit(i)">mdi-pencil</v-icon>
                <v-switch
                  v-if="item.id_status == 1"
                  inset
                  :false-value="2"
                  :true-value="1"
                  v-model="item.id_status"
                  @change="$emit('update', item)"
                ></v-switch>
              </td>
              <td>{{ item.no_operadora }}</td>
              <td>{{ item.de_operadora }}</td>
            </template>
            <template v-else>
              <td v-if="inativo != 2">
                <btn-ok @salvar="$emit('salvar', item)"></btn-ok>
                <btn-voltar @voltar="voltar(i)" />
              </td>
              <td>
                <c-text
                  :value="item.no_operadora"
                  @change="item.no_operadora = $event"
                ></c-text>
              </td>
              <td>
                <c-text
                  :value="item.de_operadora"
                  @change="item.de_operadora = $event"
                ></c-text>
              </td>
            </template>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      check: false,
      data: null,
      loading: false,
    };
  },
  watch: {
    items() {
      this.data = this.items;
      this.check = false;
      this.data.map((item) => {
        item.check = 2;
        item.edit = false;
      });
    },
  },
  props: ["items", "inativo"],
  methods: {
    checkin(event, i) {
      this.data[i].check = event;

      var cont = 0;
      this.data.map((item) => {
        if (item.check != event) cont += 1;
      });

      if (cont === 0) {
        switch (event) {
          case 1:
            this.check = true;
            break;
          case 2:
            this.check = false;
            break;
        }
      } else {
        this.check = false;
      }
      this.data = this.data.slice();
    },
    edit(key) {
      this.loading = true;
      this.data[key].edit = true;
      setTimeout(() => {
        this.loading = false;
      }, 2000);
    },
    voltar(key) {
      this.loading = true;
      this.data[key].edit = false;
      setTimeout(() => {
        this.loading = false;
      }, 2000);
    },
    novo() {
      this.data.unshift({
        no_status: "",
        de_operadora: "",
        id_status: 1,
        edit: true,
      });
      this.data = this.data.slice();
    },
    actionSelected(param) {
      let selected = [];

      this.data.map((item) => {
        if (item.check === 1) selected.push(item.id);
      });
      switch (param) {
        case "toggle":
          this.$emit("toggle", selected);
          break;
        case "excluir":
          this.$emit("excluir", selected);
          break;
      }
    },
    checkall() {
      if (this.check) {
        this.data.map((item) => {
          item.check = 1;
        });
        this.data = this.data.slice();
      } else {
        this.data.map((item) => {
          item.check = 2;
        });
        this.data = this.data.slice();
      }
    },
  },
};
</script>
<style scoped>
.controls {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.control {
  margin-left: 15px;
  margin-top: 10px;
}

.actions {
  display: flex;
  flex-direction: row;
}

.editar {
  margin-right: 13px;
}
</style>
