const axios = require("axios");
const moment = require("moment");

const actions = {
    "recipe/all/load"({commit, state}, $Progress) {
        $Progress.start();

        const loadRecipes = () => {
            axios.get("/recipe").then((result) => {
                $Progress.finish();
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
    }
};

module.exports = Object.assign({}, actions);