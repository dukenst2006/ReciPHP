<template>
    <div class="inner">
        <v-card class="primary white--text">
            <v-card-title>Neues Rezept</v-card-title>
        </v-card>
        <v-card>
            <v-stepper v-model="stepper">
                <v-stepper-header>
                    <v-stepper-step step="1" v-bind:complete="stepper > 1">Zutaten</v-stepper-step>
                    <v-divider />
                    <v-stepper-step step="2" v-bind:complete="stepper > 2">Kochschritte</v-stepper-step>
                    <v-divider />
                    <v-stepper-step step="3">Bestätigen</v-stepper-step>
                </v-stepper-header>
                <v-stepper-content step="1">
                    <ingredient-list v-for="(list, index) in recipe.ingredientLists" :list="list"></ingredient-list>
                    <v-row>
                        <v-col xs6>
                            <v-btn primary @click.native="stepper = 2" class="stepper-button">Weiter</v-btn>
                        </v-col>
                        <v-col xs6 class="text-xs-right">
                            <v-btn floating="floating" secondary @click.native="addNewIngredientList">
                                <v-icon>add</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="2">
                    <v-btn primary @click.native="stepper = 3">Weiter</v-btn>
                    <v-btn flat @click.native="stepper = 1" class="stepper-button">Zurück</v-btn>
                </v-stepper-content>
                <v-stepper-content step="3">

                    <v-btn primary>Speichern</v-btn>
                    <v-btn flat @click.native="stepper = 2" class="stepper-button">Zurück</v-btn>
                </v-stepper-content>
            </v-stepper>
        </v-card>
    </div>
</template>

<script>
    import { Recipe, Ingredient, IngredientList, Step } from "./../../../Recipe/Recipe";

    export default {
        data() {
            return {
                stepper: 0,
                recipe: new Recipe(),
            };
        },
        components: {
            "ingredient-list": require("./../../Recipe/IngredientList.vue"),
        },
        methods: {
            addNewIngredientList() {
                this.recipe.ingredientLists.push(new IngredientList("", []));
            }
        }
    }
</script>

<style>

</style>