import './styles/app.scss';
import 'bootstrap/dist/css/bootstrap.min.css';
import { registerVueControllerComponents } from '@symfony/ux-vue';

import { createApp } from 'vue';
import App from '../frontend/App.vue';

// Registers Vue.js controller components to allow loading them from Twig
//
// Vue.js controller components are components that are meant to be rendered
// from Twig. These components can then rely on other components that won't be
// called directly from Twig.
//
// By putting only controller components in `vue/controllers`, you ensure that
// internal components won't be automatically included in your JS built file if
// they are not necessary.
//registerVueControllerComponents(require.context('./../frontend', true, /\.vue$/));

// If you prefer to lazy-load your Vue.js controller components, in order to reduce to keep the JavaScript bundle the smallest as possible,
// and improve performances, you can use the following line instead:
registerVueControllerComponents(require.context('./../frontend', true, /\.vue$/, 'lazy'));

import router from '../frontend/router';
import store from '../frontend/store';
import BootstrapVue from 'bootstrap-vue-next';
import { BootstrapIconsPlugin } from 'bootstrap-icons-vue';
import Icon from '../frontend/components/icon.vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

const app = createApp(App);

app.use(router);
app.use(store);
app.use(BootstrapVue);
app.use(BootstrapIconsPlugin);
app.component('icon', Icon);
app.mount('#app');
