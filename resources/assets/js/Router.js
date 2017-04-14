const VueRouter = require("vue-router").default;

const homeRoutes = [
    {
        path: "/home",
        component: require("./components/Pages/HomePage.vue"),
        meta: {
            title: "Home - ReciPHP",
        },
    },
];

const recipeRoutes = [
    {
        path: "/recipe",
        component: require("./components/Pages/Recipe/index.vue"),
        meta: {
            title: "Rezepte - ReciPHP",
        },
    },
    {
        path: "/recipe/new",
        component: require("./components/Pages/Recipe/edit.vue"),
        meta: {
            title: "Neues Rezept - ReciPHP",
        },
    },
    {
        path: "/recipe/:recipeId",
        component: require("./components/Pages/Recipe/show.vue"),
        meta: {
            title: window.Store.state.recipe.name,
        },
        name: "recipe",
    }
];

const userRoutes = [
    {
        path: "/users",
        component: require("./components/Pages/UsersPage.vue"),
        meta: {
            title: "Users - ReciPHP",
        },
    },
];

const routes = [
    ...homeRoutes,
    ...recipeRoutes,
    ...userRoutes,
];

const router = new VueRouter({
    routes,
    mode: "history",
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
});

module.exports = router;