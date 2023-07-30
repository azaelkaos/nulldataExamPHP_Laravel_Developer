import './assets/main.css'

import { createApp } from 'vue'
// import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { vuetify } from "./plugins/vuetify";

import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App)

// app.use(createPinia())
app.use(router)

app.use(vuetify);
app.use(Toast, {
  position: POSITION.BOTTOM_RIGHT,
  timeOut: 8000,
  maxToasts: 5,
});

app.mount('#app')
