const Vuex = require("vuex");
const createPersist = require("vuex-localstorage").default;

const {Recipe, IngredientList, Step} = require("./Recipe/Recipe");

let store;
const debug = false;

const state = {
    registerModalOpen: false,
    user: {
        name: "",
        email: "",
        loggedIn: false,
        isAdmin: false,
        id: -1,
    },
    recipe: new Recipe(),
    ajax: false,
    recipes: [],
    lastUpdate: -1,
};

if (debug) {
    store = new Vuex.Store({
        state,
        mutations: require("./Mutators/mutators"),
        actions: require("./Actions/actions"),
    });
} else {
    store = new Vuex.Store({
        plugins: [createPersist({
            namespace: "reciphp",
            initialState: state,
        })],
        mutations: require("./Mutators/mutators"),
        actions: require("./Actions/actions"),
    });
}

module.exports = store;