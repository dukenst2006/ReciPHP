<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
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
    <v-toolbar>
        <v-toolbar-title>Toolbar</v-toolbar-title>
    </v-toolbar>
    <main>
        <v-content>
            <v-container fluid>
                <div class="title">Main Content</div>
            </v-container>
        </v-content>
    </main>
    <v-footer>Footer</v-footer>
</v-app>
<script src="/js/app.js"></script>
</body>
</html>