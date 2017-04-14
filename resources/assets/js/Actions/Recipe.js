const axios = require("axios");
const moment = require("moment");
const { snakeToCamel, deepFor } = require("./../util");

const actions = {
    "recipe/all/load"({commit, state}, $Progress) {
        $Progress.start();

        const loadRecipes = () => {
            axios.get("/recipe").then((result) => {
                $Progress.finish();

                deepFor(result.data, (object, key) => {
                    const camel = snakeToCamel(key);
                    if(key !== camel) {
                        let property = object[key];
                        delete object[key];
                        object[camel] = property;
                    }
                    return object;
                });

                commit("recipe/all/loaded", result.data);
            }, (error) => {
                $Progress.fail();
                throw error;
            });
        };

        axios.get("/recipe/lastChange").then((result) => {
            let time = moment(result.data);
            if(time.valueOf() === state.lastUpdate) {
                $Progress.finish();
                return;
            }
            commit("recipe/all/lastUpdate", time);
            loadRecipes();
        }, (error) => {
            $Progress.fail();
            throw error;
        });
    },
    "recipe/store"({commit, state}, $Progress) {
        $Progress.start();
        commit("ajax/activate");
        axios.post("/recipe", state.recipe).then((result) => {
            if (result.status === 200) {
                $Progress.finish();
                commit("ajax/deactivate");
                commit("recipe/clearCurrent");
                commit("router", {
                    name: "recipe",
                    params: {
                        recipeId: result.data,
                    },
                });
            }
        }, (error) => {
            $Progress.fail();
            throw error;
        });
    },
    "recipe/update"({commit, state}, $Progress) {
        $Progress.start();
        axios.put(`/recipe/${state.recipe.id}`, state.recipe).then((result) => {
            console.log(result);
            if (result.status === 200) {
                $Progress.finish();
            }
        }, (error) => {
            $Progress.fail();
            throw error;
        });
    },
    "recipe/delete"({commit, state}, $Progress) {
        $Progress.start();

        const id = state.recipe.id;

        axios.delete(`/recipe/${id}`).then((result) => {
            if(result.status === 200) {
                $Progress.finish();
                commit("recipe/current/clear");
                commit("recipe/all/remove", id);
                commit("router", "/recipe");
            }
        }, (error) => {
            $Progress.fail();
            throw error;
        })
    },
    "recipe/set"({commit, state}, {$Progress, id}) {
        $Progress.start();
        let recipe = (() => {
            for(let i = 0; i < state.recipes.length; i++) {
                const recipe = state.recipes[i];
                if(recipe.id === id) {
                    return recipe;
                }
            }
        })();

        if(typeof recipe !== "undefined") {
            $Progress.finish();
            commit("recipe/current/set", id);
            return;
        }

        axios.get(`/recipe/${id}`).then((result) => {
            $Progress.finish();
            state.recipe = result.data;
        }, (error) => {
            $Progress.fail();
            throw error;
        });
    }
};

module.exports = Object.assign({}, actions);