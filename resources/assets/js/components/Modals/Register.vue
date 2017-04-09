<template>
    <div class="text-xs-center">
        <v-modal v-model="open">
            <v-card>
                <v-card-text>
                    <h3>Login</h3>
                    <h5 class="red--text" v-show="usernameOrPasswordWrong">Nutzername oder Passwort falsch!</h5>
                </v-card-text>
                <v-card-text class="subheading grey--text">
                    <v-text-field name="email" label="E-Mail" type="email" prepend-icon="mail" v-model="email"
                                  required></v-text-field>
                    <v-text-field name="password" label="Passwort" type="password" prepend-icon="lock"
                                  v-model="password" required></v-text-field>
                    <v-checkbox label="An mich erinnern" primary v-model="remember"/>
                </v-card-text>
                <v-card-row actions>
                    <v-spacer></v-spacer>
                    <v-btn flat v-on:click.native="setModalVisibility(false)" class="primary--text">Abbrechen</v-btn>
                    <v-btn flat v-on:click.native="submitForm" class="primary--text">Einloggen</v-btn>
                </v-card-row>
            </v-card>
        </v-modal>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                email: "",
                password: "",
                remember: false,
                usernameOrPasswordWrong: false
            };
        },
        computed: {
            open: function () {
                return this.$store.state.registerModalOpen;
            }
        },
        methods: {
            setModalVisibility(visible) {
                this.$store.commit("setRegisterModalOpen", visible);
            },
            submitForm() {
                this.$Progress.start();

                let data = {
                    email: this.$data.email,
                    password: this.$data.password,
                    remember: this.$data.remember,
                };

                axios.post("/login", data).then((data) => {
                    this.$Progress.finish();
                    this.$data.usernameOrPasswordWrong = false;
                    this.$store.dispatch("getUserData");
                    this.setModalVisibility(false);
                }, (data) => {
                    this.$Progress.fail();
                    this.$data.usernameOrPasswordWrong = true;
                });
            }
        }
    };
</script>

<style>

</style>