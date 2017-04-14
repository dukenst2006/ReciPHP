<template>
    <div class="inner recipe-index">
        <v-card>
            <v-card-title>
                Rezepte
                <v-spacer></v-spacer>
                <v-text-field
                        append-icon="search"
                        label="Suche"
                        single-line
                        hide-details
                        v-model="search"
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    v-model="recipes"
                    :search="search"
            >
                <template slot="items" scope="props">
                    <td @click="openRecipe(props.item.id)">{{ props.item.name }}</td>
                    <td @click="openRecipe(props.item.id)">{{ props.item.description }}</td>
                    <td @click="openRecipe(props.item.id)">{{ props.item.user.name }}</td>
                    <td @click="openRecipe(props.item.id)"></td>
                    <td @click="openRecipe(props.item.id)"></td>
                    <td @click="openRecipe(props.item.id)"></td>
                </template>
            </v-data-table>
        </v-card>
        <v-btn floating="floating" id="new-recipe" primary @click.native="newRecipe">
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    {
                        text: "Rezept",
                        left: true,
                        sortable: false,
                        value: "name",
                    },
                    {
                        text: "Beschreibung",
                        left: true,
                        sortable: false,
                        value: "description",
                    },
                    {
                        text: "Autor",
                        left: true,
                        value: "author",
                    },
                    {
                        text: "Tags",
                        sortable: false,
                        value: "tags",
                    },
                    {
                        text: "Bewertung",
                        value: "rating"
                    },
                    {
                        text: "Likes",
                        value: "likes",
                    }
                ],
                search: "",
            };
        },
        methods: {
            newRecipe() {
                this.$router.push("/recipe/new");
            },
            openRecipe(id) {
                this.$router.push({
                    name: "recipe",
                    params: {
                        recipeId: id
                    },
                });
            }
        },
        mounted() {
            this.$store.dispatch("recipe/all/load", this.$Progress);
        },
        computed: {
            recipes() {
                return this.$store.state.recipes;
            }
        }
    }
</script>

<style>
    .recipe-index .datatable__actions__select {
        font-size: 0;
    }

    .recipe-index .datatable__actions__select::before {
        content: "Elemente pro Seite:";
        font-size: 1rem;
    }

    .recipe-index tbody td {
        cursor: pointer;
    }
</style>