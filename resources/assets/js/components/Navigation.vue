<template>
    <v-card id="footer">
        <v-bottom-nav absolute value="true" class="transparent">
            <v-btn flat light class="teal--text" :router="true" to="/home">
                <span>Home</span>
                <v-icon>home</v-icon>
            </v-btn>
            <v-btn flat light class="teal--text" :router="true" to="/recipe">
                <span>Rezepte</span>
                <v-icon>book</v-icon>
            </v-btn>
            <v-btn flat light class="teal--text" :router="true" to="/user">
                <span>Users</span>
                <v-icon>person</v-icon>
            </v-btn>
        </v-bottom-nav>
    </v-card>
</template>

<script>
    export default {

    }
</script>

<style>

</style>