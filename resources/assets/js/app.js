
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { $, Vue } from "./bootstrap";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuex from "vuex";
import VueRouter from "vue-router";
import { sync } from "vuex-router-sync";

import Store from "./Store";
import Router from "./Router";

Vue.use(VueRouter);

import Vuetify from "vuetify";
import VueProgressBar from "vue-progressbar";

sync(Store, Router);

Vue.use(Vuetify);
Vue.use(VueProgressBar, {
    color: "#84ffff",
    fail: "red",
    height: "4px"
});

const app = new Vue({
    el: '#app',
    router: Router,
    store: Store,
    components: {
        "navigation": require("./components/Navigation.vue"),
        "register-modal": require("./components/Modals/Register.vue"),
        "user-dropdown": require("./components/UserDropdown.vue"),
    },
    methods: {
        setModalVisibility(visible) {
            this.$store.commit("setRegisterModalOpen", visible);
        }
    },
    computed: {
        user() {
            return {
                loggedIn: this.$store.state.userLoggedIn,
                email: this.$store.state.userEmail,
                name: this.$store.state.userName,
            };
        },
    }
});

app.$store.dispatch("getUserData");