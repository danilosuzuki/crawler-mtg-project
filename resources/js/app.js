import './bootstrap';
import '/resources/css/app.css';
import router from './router/router';
import { createApp } from 'vue';
import App from './App.vue';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const options = {
    // Opções de configuração do toast
};

const app = createApp(App);
app.use(router);
app.use(Toast, options);    
app.mount('#app');

