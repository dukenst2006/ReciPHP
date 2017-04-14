const axios = require("axios");

const user = {
    getUserData(context) {
        axios.get("/user.json").then((data) => {
            context.commit("userData/set", data.data);
            window.axios.defaults.headers.common["X-CSRF-TOKEN"] = data.data.token;
        });
    },
};

module.exports = Object.assign({}, user);