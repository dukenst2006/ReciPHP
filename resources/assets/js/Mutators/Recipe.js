const {Recipe, IngredientList, Step} = require("./../Recipe/Recipe");

const ingredientList = {
    "recipe/ingredientList/add"(state) {
        state.recipe.ingredientLists.push(new IngredientList("", []));
    },
    "recipe/ingredientList/updateName"(state, payload) {
        state.recipe.ingredientLists[payload.index].name = payload.value;
    },
    "recipe/ingredientList/updateIngredients"(state, payload) {
        state.recipe.ingredientLists[payload.index].ingredients = payload.ingredients;
    },
    "recipe/ingredientList/updateOrder"(state, payload) {
        state.recipe.ingredientLists = payload;
    },
    "recipe/ingredientList/remove"(state, index) {
        state.recipe.ingredientLists.splice(index, 1);
    }
};

const step = {
    "recipe/step/updateTitle"(state, payload) {
        state.recipe.steps[payload.index].title = payload.value;
    },
    "recipe/step/updateBody"(state, payload) {
        state.recipe.steps[payload.index].body = payload.value;
    },
    "recipe/step/add"(state) {
        state.recipe.steps.push(new Step("", ""));
    },
    "recipe/step/updateOrder"(state, payload) {
        state.recipe.steps = payload;
    },
    "recipe/step/remove"(state, index) {
        state.recipe.steps.splice(index, 1);
    }
};

const all = {
    "recipe/all/clear"(state) {
        state.recipes.splice(0, state.recipes.length);
    },
    "recipe/all/loaded"(state, recipes) {
        recipes.forEach((recipe) => {
            state.recipes.push(recipe);
        });
    },
    "recipe/all/lastUpdate"(state, lastUpdate) {
        state.lastUpdate = lastUpdate.valueOf();
    }
};

const various = {
    "recipe/name/set"(state, value) {
        state.recipe.name = value;
    },
    "recipe/description/set"(state, value) {
        state.recipe.description = value;
    },
    "recipe/clearCurrent"(state) {
        state.recipe = new Recipe();
    },
    "recipe/current/set"(state, id) {
        state.recipe = (() => {
            for(let i = 0; i < state.recipes.length; i++) {
                const recipe = state.recipes[i];
                if(recipe.id === id) {
                    return recipe;
                }
            }
        })();
    }
};

module.exports = Object.assign({}, ingredientList, step, all, various);