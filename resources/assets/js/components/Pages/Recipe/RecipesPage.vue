<template>
    <div class="inner">
        <v-btn floating="floating" id="new-recipe" primary @click.native="newRecipe">
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        methods: {
            newRecipe() {
                this.$router.push("/recipes/new");
            }
        }
    }
</script>

<style>

</style>