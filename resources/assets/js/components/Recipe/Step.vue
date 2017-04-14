<template>
    <div class="recipe-step">
        <h5>Schritt {{ index + 1 }}<span v-if="step.title.length > 0">: {{ step.title }}</span></h5>
        <p>
            <vue-markdown :source="step.body" class="markdown"></vue-markdown>
        </p>
    </div>
</template>

<script>
    import VueMarkdown from "vue-markdown";

    export default {
        props: ["step", "index"],
        components: {
            "vue-markdown": VueMarkdown,
        }
    };
</script>

<style>
    .recipe .recipe-step {
        font-size: 16px;
        margin-bottom: 2rem;
    }

    .recipe .recipe-step > h5 {
        margin-bottom: 0.4rem;
        font-weight: bold;
    }

    .recipe .recipe-step > *:not(h5) {
        padding-left: 1em;
    }

    .recipe .recipe-step .markdown {
        text-align: justify;
    }
</style>