import Vuex from "vuex";

import axios from "axios";

const store = new Vuex.Store({
    state: {
        registerModalOpen: false,
        userLoggedIn: false,
        userEmail: "",
        userName: "",
    },
    mutations: {
        setRegisterModalOpen(state, open) {
            state.registerModalOpen = open;
        },
        setUserData(state, data) {
            state.userLoggedIn = data.loggedIn;
            state.userEmail = data.email || "";
            state.userName = data.name || "";
        }
    },
    actions: {
        getUserData(context) {
            axios.get("/user.json").then((data) => {
                context.commit("setUserData", data.data);
                window.axios.defaults.headers.common["X-CSRF-TOKEN"] = data.data.token;
            });
        },
    }
});

export default store;