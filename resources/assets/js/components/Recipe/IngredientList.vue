<template>
    <v-card class="elevation-10 stepper-step">
        <v-card-text>
            <v-text-field name="title" label="Name" v-model="list.name"></v-text-field>
            <v-text-field name="ingredients" label="Zutaten (eine Zeile pro Zutat. Name und Menge durch ':' trennen)" multi-line @input.native="updateIngredients"></v-text-field>
        </v-card-text>
    </v-card>
</template>

<script>
    import { Ingredient } from "./../../Recipe/Recipe";

    export default {
        props: ["list"],
        methods: {
            updateIngredients(event) {
                let value = event.srcElement.value;
                let lines = value.split("\n");
                let ingredients = [];
                lines.forEach((line) => {
                    let parts = line.split(":");
                    if(parts.length === 2) {
                        ingredients.push(new Ingredient(parts[0].trim(), parts[1].trim()));
                    }
                });
                this.list.ingredients = ingredients;
            }
        }
    }
</script>

<style>

</style>