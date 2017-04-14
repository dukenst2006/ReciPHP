module.exports = {
    "userData/set"(state, data) {
        state.user.loggedIn = data.loggedIn;
        state.user.email = data.email || "";
        state.user.name = data.name || "";
    },
    "ajax/activate"(state) {
        state.ajax = true;
    },
    "ajax/deactivate"(state) {
        state.ajax = false;
    },
    "router"(state, route) {
        window.Router.push(route);
    }
};