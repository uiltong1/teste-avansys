import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import CSelect from './components/form/CSelect.vue'
import CText from './components/form/CText.vue'
import BtnNovo from './components/buttons/BtnNovo.vue'
import BtnExcluir from './components/buttons/BtnExcluir.vue'
import BtnToggle from './components/buttons/BtnToggle.vue'
import BtnOk from './components/buttons/BtnOk.vue'
import BtnVoltar from './components/buttons/BtnVoltar.vue'
import CTable from './components/list/CTable.vue'
import CLoading from './components/form/CLoading.vue'

Vue.component('CSelect', CSelect);
Vue.component('CText', CText);
Vue.component('BtnNovo', BtnNovo);
Vue.component('BtnExcluir', BtnExcluir);
Vue.component('BtnToggle', BtnToggle);
Vue.component('BtnOk', BtnOk);
Vue.component('BtnVoltar', BtnVoltar);
Vue.component('CTable', CTable);
Vue.component('CLoading', CLoading);


Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
