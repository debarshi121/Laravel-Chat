require('./bootstrap');

import Vue from 'vue'

import Chat from './components/Chat.vue'

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

const app = new Vue({
    el: '#app',
    components: { Chat }
})