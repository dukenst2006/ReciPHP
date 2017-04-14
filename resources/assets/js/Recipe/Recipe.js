import Ingredient from "./Ingredient";
import IngredientList from "./IngredientList";
import Step from "./Step";

const Recipe = class Recipe {
    constructor(name = "", description = "", id = -1, ingredientLists = [new IngredientList("", [])], steps = [new Step("", "")]) {
        this.name = name;
        this.description = description;
        this.ingredientLists = ingredientLists;
        this.steps = steps;
        this.id = id;
    }
};

export {
    Recipe,
    Ingredient,
    IngredientList,
    Step,
};