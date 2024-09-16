import './bootstrap';

import Alpine from 'alpinejs';

window.Vue = require('vue').default;

Vue.component('chat-component', require('./components/ChatComponent.vue').default);

const app = new Vue({
    el: '#app',
});
window.Alpine = Alpine;

Alpine.start();
