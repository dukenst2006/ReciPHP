<template>
    <v-card class="elevation-10 stepper-step recipe-step">
        <v-card-text>
            <h5>Schritt {{ (index + 1) }}</h5>
            <span class="icons">
                <v-btn icon="icon" class="teal--text" @click.native="removeThis">
                    <v-icon>remove_circle</v-icon>
                </v-btn>
                <v-btn v-show="showMoveIcon" icon="icon" class="teal--text no-pointer-events">
                    <v-icon>open_with</v-icon>
                </v-btn>
            </span>
            <h6>Name</h6>
            <v-text-field name="title" label="Name" v-model="title"></v-text-field>
            <v-row>
                <v-col xs12 md6>
                    <h6>Inhalt</h6>
                    <v-text-field name="body" label="Inhalt (Formatierung mittels Markdown)" v-model="body"
                                  multi-line></v-text-field>
                </v-col>
                <v-col xs12 md6>
                    <h6>Vorschau</h6>
                    <span class="markdown">
                        <vue-markdown :source="body"></vue-markdown>
                    </span>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
    import VueMarkdown from "vue-markdown";

    export default {
        props: ["index"],
        components: {
            "vue-markdown": VueMarkdown
        },
        computed: {
            title: {
                get() {
                    return this.recipe.steps[this.index].title;
                },
                set(value) {
                    this.$store.commit("recipe/step/updateTitle", {
                        index: this.index,
                        value,
                    });
                }
            },
            body: {
                get() {
                    return this.recipe.steps[this.index].body;
                },
                set(value) {
                    this.$store.commit("recipe/step/updateBody", {
                        index: this.index,
                        value,
                    });
                }
            },
            recipe() {
                return this.$store.state.recipe;
            },
            showMoveIcon() {
                return this.recipe.steps.length > 1;
            }
        },
        methods: {
            removeThis() {
                this.$store.commit("recipe/step/remove", this.index);
            }
        }
    }
</script>

<style>
    .recipe-step.stepper-step > div > h5 {
        display: inline-block;
    }

    .recipe-step.stepper-step .icons {
        float: right;
    }

    .recipe-step.stepper-step .markdown {
        text-align: justify;
    }
</style>