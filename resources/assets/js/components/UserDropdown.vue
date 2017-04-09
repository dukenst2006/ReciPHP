<template>
    <v-menu offset-y>
        <v-btn primary dark slot="activator">{{ user.name }}</v-btn>
        <v-list>
            <v-list-item>
                <v-list-tile>
                    <v-list-tile-title>{{ user.name }}</v-list-tile-title>
                </v-list-tile>
            </v-list-item>
            <v-list-item>
                <v-list-tile>
                    <v-list-tile-title>Meine Rezepte</v-list-tile-title>
                </v-list-tile>
            </v-list-item>
            <v-list-item>
                <v-list-tile @click.native="logout">
                    <v-list-tile-title>Logout</v-list-tile-title>
                </v-list-tile>
            </v-list-item>
        </v-list>
    </v-menu>
</template>

<script>
    import axios from "axios";

    export default {
        computed: {
            user() {
                return {
                    loggedIn: this.$store.state.userLoggedIn,
                    email: this.$store.state.userEmail,
                    name: this.$store.state.userName,
                };
            },
        },
        methods: {
            logout() {
                this.$Progress.start();
                axios.post("/logout").then(() => {
                    this.$Progress.finish();
                    this.$store.dispatch("getUserData");
                }, () => {
                    this.$Progress.fail();
                });
            }
        }
    }
</script>

<style>

</style>