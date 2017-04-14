<template>
    <div class="recipe-show" v-if="valid">
        <v-card>
            <v-card-title><h3>{{ recipe.name }}</h3></v-card-title>
            <v-card-text>
                <recipe :recipe="recipe"></recipe>
            </v-card-text>
        </v-card>
        <div class="floating-buttons" v-if="mayEditRecipe">
            <v-btn floating="floating" primary @click.native="editRecipe">
                <v-icon>edit</v-icon>
            </v-btn>
            <v-btn floating="floating" error @click.native="deleteRecipe">
                <v-icon>delete</v-icon>
            </v-btn>
        </div>
    </div>
    <div v-else>
        <h5>Something went wrong!</h5>
    </div>
</template>

<script>
    export default {
        components: {
            "recipe": require("./../../Recipe/Recipe.vue"),
        },
        computed: {
            recipe() {
                return this.$store.state.recipe;
            },
            mayEditRecipe() {
                return this.$store.state.user.isAdmin || this.$store.state.user.id === this.recipe.user.id;
            },
            valid() {
                return typeof this.recipe !== "undefined";
            }
        },
        methods: {
            editRecipe() {
                this.$store.commit("router", {

                });
            },
            deleteRecipe() {
                if(confirm("Soll dieses Rezept wirklich gelöscht werden?")) {
                    this.$store.dispatch("recipe/delete", this.$Progress);
                }
            }
        },
        mounted() {
            this.$store.dispatch("recipe/set", {
                id: this.$store.state.route.params.recipeId,
                $Progress: this.$Progress,
            });
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

    .recipe-show .floating-buttons {
        position: fixed;
        right: 2em;
        bottom: 5em;
    }
</style>