
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

const Store = require("./Store");
window.Store = Store;

const Router = require("./Router");
window.Router = Router;

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
    mounted() {
        this.$store.commit("ajax/deactivate");
    },
    components: {
        "navigation": require("./components/Navigation.vue"),
        "register-modal": require("./components/Modals/Login.vue"),
        "user-dropdown": require("./components/UserDropdown.vue"),
    },
    methods: {
        setModalVisibility(visible) {
            this.$store.commit("registerModal/visible", visible);
        }
    },
    computed: {
        user() {
            return this.$store.state.user;
        }
    },
});

app.$store.dispatch("getUserData");