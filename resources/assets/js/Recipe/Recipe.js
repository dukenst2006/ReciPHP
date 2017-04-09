import Ingredient from "./Ingredient";
import IngredientList from "./IngredientList";
import Step from "./Step";

const Recipe = class Recipe {
    constructor(ingredientLists = [new IngredientList("", [])], steps = [new Step("", ""    )]) {
        this.ingredientLists = ingredientLists;
        this.steps = steps;
    }
};

export {
    Recipe,
    Ingredient,
    IngredientList,
    Step,
};