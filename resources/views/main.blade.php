<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#4db6ac">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#4db6ac">

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
            <v-col xs8>
                <v-toolbar-title><img src="/logo.png"></v-toolbar-title>
            </v-col>
            <v-col xs4>
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