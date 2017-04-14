<template>
    <v-card class="recipe-show">
        <v-card-title><h3>{{ recipe.name }}</h3></v-card-title>
        <v-card-text>
            <recipe :recipe="recipe"></recipe>
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        components: {
            "recipe": require("./../../Recipe/Recipe.vue"),
        },
        computed: {
            recipe() {
                return this.$store.state.recipe;
            }
        }
    }
</script>

<style>
    .recipe-show {
        margin: 2em;
    }

    .recipe-show .card__title {
        padding-bottom: 0;
    }

    .recipe-show .card__text {
        padding-top: 0;
    }
</style>