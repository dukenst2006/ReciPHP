<template>
    <div class="recipe">
        <h4>Zutaten</h4>
        <v-row>
            <v-col xs12 lg5>
                <ingredient-list v-for="list in recipe.ingredientLists" :ingredientList="list"></ingredient-list>
            </v-col>
            <v-col xs12 lg2 id="converter">
                <h6>Umrechnen</h6>
                <v-text-field label="Umrechnungsfaktor" v-model="conversionFactor" id="conversion"></v-text-field>
                <p>Wenn du hier einen anderen Umrechnungsfaktor als 1 einträgst, werden dir rechts die entsprechenden Zutatenmengen angezeigt!</p>
            </v-col>
            <v-col xs12 lg5>
                <ingredient-list v-for="list in convertedIngredientLists" :ingredientList="list"></ingredient-list>
            </v-col>
        </v-row>
        <v-divider></v-divider>
        <h4>Zubereitung</h4>
        <step v-for="(step, index) in recipe.steps" :step="step" :index="index"></step>
    </div>
</template>

<script>
    const _ = require("lodash");

    import { convertIngredientAmount } from "./../../util";

    import IngredientList from "./IngredientList";
    import Step from "./Step";

    export default {
        props: ["recipe"],
        components: {
            IngredientList, "ingredient-list": IngredientList,
            "step": Step,
        },
        data() {
            return {
                conversionFactor: 1,
            };
        },
        computed: {
            convertedIngredientLists() {
                const conversionFactor = Number(String(this.conversionFactor).replace(",", "."));
                if(isNaN(conversionFactor) || conversionFactor === 1 || conversionFactor === 0) {
                    return [];
                }

                return this.recipe.ingredientLists.map((ingredientList) => {
                    return {
                        name: ingredientList.name,
                        ingredients: ingredientList.ingredients.map((ingredient) => {
                            return {
                                name: ingredient.name,
                                amount: convertIngredientAmount(ingredient.amount, conversionFactor),
                            }
                        }),
                    };
                });
            }
        },
    };
</script>

<style>
    .recipe hr.divider {
        margin-top: 1em;
        margin-bottom: 1em;
    }

    #conversion {
        margin-bottom: 0;
        margin-top: 2em;
    }

    #converter {
        padding-top: 2em;
    }
</style>