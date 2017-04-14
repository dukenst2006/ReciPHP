<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet"
          type="text/css">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/css/app.css">
    <script>
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}"
        };
    </script>
</head>
<body>
<v-app id="app">
    <vue-progress-bar></vue-progress-bar>
    <v-toolbar>
        <v-row>
            <v-col xs12 md6>
                <v-toolbar-title>ReciPHP</v-toolbar-title>
            </v-col>
            <v-col xs12 md6>
            <div class="text-xs-right">
                <v-btn v-if="!user.loggedIn" @click.native.stop="setModalVisibility(true)" secondary>Login</v-btn>
                <user-dropdown v-if="user.loggedIn"></user-dropdown>
            </div>
            </v-col>
        </v-row>
    </v-toolbar>
    <main>
        <v-content>
            <v-container fluid>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </v-container>
        </v-content>
    </main>
    <navigation></navigation>
    <register-modal></register-modal>
</v-app>
<script src="/js/app.js?{{ time() }}"></script>
</body>
</html>