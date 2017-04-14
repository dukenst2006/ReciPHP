<template>
    <div class="ingredient-list">
        <h5>{{ ingredientList.name }}</h5>
        <ul>
            <li v-for="ingredient in ingredientList.ingredients">{{ ingredient.name }}: {{ ingredient.amount }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ["ingredientList"]
    };
</script>

<style>
    .recipe .ingredient-list:not(:last-child) {
        margin-bottom: 1.5rem;
        padding-bottom: 1.4rem;
        border-bottom: 1px solid lightgrey;
    }

    .recipe .ingredient-list ul {
        list-style-type: none;
        padding-left: 1em;
        font-size: 1.4rem;
    }

    .recipe .ingredient-list > h5 {
        margin-bottom: 0.3rem;
        font-weight: bold;
    }
</style>