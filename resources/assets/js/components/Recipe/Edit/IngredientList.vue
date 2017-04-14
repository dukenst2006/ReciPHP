<template>
    <v-card class="elevation-10 stepper-step ingredient-list">
        <v-card-text>
            <h6>Name</h6>
            <span class="icons">
                <v-btn icon="icon" class="teal--text" @click.native="removeThis">
                    <v-icon>remove_circle</v-icon>
                </v-btn>
                <v-btn v-show="showMoveIcon" icon="icon" class="teal--text no-pointer-events">
                    <v-icon>open_with</v-icon>
                </v-btn>
            </span>
            <v-text-field name="title" label="Name" v-model="name"></v-text-field>
            <h6>Zutaten</h6>
            <v-text-field name="ingredients" label="Zutaten (eine Zeile pro Zutat. Name und Menge durch ':' trennen)"
                          multi-line @input.native="updateIngredients" :value="textFieldValue"></v-text-field>
        </v-card-text>
    </v-card>
</template>

<script>
    import {Ingredient} from "../../../Recipe/Recipe";
    const _ = require("lodash");

    export default {
        props: ["index"],
        methods: {
            updateIngredients(event) {
                let value = event.srcElement.value;
                let lines = value.split("\n");
                let ingredients = [];
                lines.forEach((line) => {
                    let parts = line.split(":");
                    if (parts.length === 2 && parts.filter((p) => {
                            return p.trim() !== "";
                        }).length === 2) {
                        ingredients.push(new Ingredient(parts[0].trim(), parts[1].trim()));
                    }
                });
                if (!_.isEqual(ingredients, this.recipe.ingredientLists[this.index].ingredients)) {
                    this.$store.commit("recipe/ingredientList/updateIngredients", {
                        index: this.index,
                        ingredients,
                    });
                }
            },
            removeThis() {
                this.$store.commit("recipe/ingredientList/remove", this.index);
            }
        },
        computed: {
            name: {
                get() {
                    return this.recipe.ingredientLists[this.index].name;
                },
                set(value) {
                    this.$store.commit("recipe/ingredientList/updateName", {
                        index: this.index,
                        value: value,
                    });
                }
            },
            recipe() {
                return this.$store.state.recipe;
            },
            showMoveIcon() {
                return this.recipe.ingredientLists.length > 1;
            }
        },
        mounted() {
            let ingredients = this.recipe.ingredientLists[this.index].ingredients;
            let string = "";
            ingredients.forEach((ingredient) => {
                string += `${ingredient.name}: ${ingredient.amount}\n`;
            });
            this.textFieldValue = string;
        },
        data() {
            return {
                textFieldValue: "",
            };
        }
    }
</script>

<style>
    .ingredient-list > div > h6 {
        display: inline;
    }

    .ingredient-list .icons {
        float: right;
    }
</style>