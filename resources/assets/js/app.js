/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from "vue";
import Logout from "./components/Logout.vue";
import Notifications from "./components/Notifications.vue";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('logout', Logout);
Vue.component('notifications', Notifications);

const app = new Vue({
    el: '#app',

    data: {
        unreadNotifications: 0,
    },

    created() {
        $('#flash-overlay-modal').modal();

        this.unreadNotifications = window.EventManager.unreadNotifications;

        var userId = window.EventManager.user.id || false;

        if (userId) {
            Echo.private(`App.User.${userId}`)
                .notification((notification) => {
                    this.unreadNotifications++;
                });
        }
    }
});
