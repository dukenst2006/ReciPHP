<template>
    <div class="inner new-recipe-page">
        <v-card class="primary white--text">
            <v-card-title class="title">
                <v-text-field single-line label="Name" v-model="name"></v-text-field>
                <v-text-field multi-line label="Beschreibung" v-model="description"></v-text-field>
            </v-card-title>
        </v-card>
        <v-card>
            <v-stepper v-model="stepper">
                <v-stepper-header>
                    <v-stepper-step step="1" v-bind:complete="stepper > 1">Zutaten</v-stepper-step>
                    <v-divider/>
                    <v-stepper-step step="2" v-bind:complete="stepper > 2">Kochschritte</v-stepper-step>
                    <v-divider/>
                    <v-stepper-step step="3">Bestätigen</v-stepper-step>
                </v-stepper-header>
                <v-stepper-content step="1">
                    <draggable v-model="ingredientLists" class="padding-bottom">
                        <ingredient-list v-for="(list, index) in ingredientLists" :index="index"
                                         :key="index"></ingredient-list>
                    </draggable>
                    <v-row>
                        <v-col xs6>
                            <v-btn primary @click.native="stepper = 2"
                                   :disabled="requiredFieldsNotFilledStepper1">Weiter
                            </v-btn>
                            <p v-show="requiredFieldsNotFilledStepper1">
                                Um fortfahren zu können, musst du dich entweder auf eine Liste beschränken oder allen Listen einen Namen geben.</p>
                        </v-col>
                        <v-col xs6 class="text-xs-right">
                            <v-btn floating="floating" secondary @click.native="addNewIngredientList">
                                <v-icon>add</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="2">
                    <draggable v-model="steps" class="padding-bottom">
                        <step v-for="(step, index) in steps" :index="index" :key="index"></step>
                    </draggable>
                    <v-row>
                        <v-col xs6>
                            <v-btn primary @click.native="stepper = 3" :disabled="requiredFieldsNotFilledStepper2">
                                Weiter
                            </v-btn>
                            <v-btn flat @click.native="stepper = 1">Zurück</v-btn>
                            <p v-show="requiredFieldsNotFilledStepper2">
                                Um fortfahren zu können, müssen alle Schritte Inhalt haben.</p>
                        </v-col>
                        <v-col xs6 class="text-xs-right">
                            <v-btn floating="floating" secondary @click.native="addNewStep">
                                <v-icon>add</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="3">
                    <recipe :recipe="recipe"></recipe>
                    <v-btn primary @click.native="saveRecipe" :disabled="requiredFieldsNotFilledStepper3 || ajax">
                        {{ saveButtonCaption }}
                    </v-btn>
                    <v-btn flat @click.native="stepper = 2">Zurück</v-btn>
                    <p v-show="requiredFieldsNotFilledStepper3">
                        Um fortfahren zu können, musst du dem Rezept einen Namen geben!</p>
                </v-stepper-content>
            </v-stepper>
        </v-card>
    </div>
</template>

<script>
    import {Recipe, Ingredient, IngredientList, Step} from "./../../../Recipe/Recipe";

    export default {
        components: {
            "ingredient-list": require("./../../Recipe/Edit/IngredientList.vue"),
            "step": require("./../../Recipe/Edit/Step.vue"),
            "draggable": require("vuedraggable"),
            "recipe": require("./../../Recipe/Recipe.vue"),
        },
        data() {
            return {
                stepper: 0,
            };
        },
        methods: {
            addNewIngredientList() {
                this.$store.commit("recipe/ingredientList/add");
            },
            addNewStep() {
                this.$store.commit("recipe/step/add");
            },
            saveRecipe() {
                if(this.recipe.id === -1) {
                    this.$store.dispatch("recipe/store", this.$Progress);
                } else {
                    this.$store.dispatch("recipe/update", this.$Progress);
                }
            },
        },
        computed: {
            recipe() {
                return this.$store.state.recipe;
            },
            ingredientLists: {
                get() {
                    return this.recipe.ingredientLists;
                },
                set(value) {
                    this.$store.commit("recipe/ingredientList/updateOrder", value);
                }
            },
            steps: {
                get() {
                    return this.recipe.steps;
                },
                set(value) {
                    this.$store.commit("recipe/step/updateOrder", value);
                }
            },
            name: {
                get() {
                    return this.recipe.name;
                },
                set(value) {
                    this.$store.commit("recipe/name/set", value);
                }
            },
            description: {
                get() {
                    return this.recipe.description;
                },
                set(value) {
                    this.$store.commit("recipe/description/set", value);
                }
            },
            requiredFieldsNotFilledStepper1() {
                // Check all ingredient lists
                for (let i = 0; i < this.recipe.ingredientLists.length; i++) {
                    let list = this.recipe.ingredientLists[i];
                    // If either no ingredients or no name exists, the user may not continue
                    if (list.ingredients.length === 0 || (list.name.length === 0 && this.recipe.ingredientLists.length > 1)) {
                        return true;
                    }
                }

                return false;
            },
            requiredFieldsNotFilledStepper2() {
                // Check all steps
                for (let i = 0; i < this.recipe.steps.length; i++) {
                    let step = this.recipe.steps[i];
                    // If either no title or no body is given, the user may not continue
                    if (step.body.length === 0) {
                        return true;
                    }
                }

                return false;
            },
            requiredFieldsNotFilledStepper3() {
                return this.recipe.name.length === 0;
            },
            saveButtonCaption() {
                return this.recipe.id === -1 ? "Speichern" : "Änderungen speichern";
            },
            ajax() {
                return this.$store.state.ajax;
            },
        }
    }
</script>

<style>
    .new-recipe-page {
        height: auto !important;
        padding-bottom: 20px !important;
    }

    .new-recipe-page .title {
        padding-bottom: 0;
        display: block;
    }

    .new-recipe-page .title > div {
        margin: 0;
    }

    .new-recipe-page .title label {
        font-size: 20px;
        color: white;
    }

    .new-recipe-page .title input {
        color: white !important;
        font-size: 20px;
    }

    .new-recipe-page .title textarea {
        color: white !important;
    }

    .new-recipe-page .padding-bottom {
        padding-bottom: 3rem;
    }
</style>