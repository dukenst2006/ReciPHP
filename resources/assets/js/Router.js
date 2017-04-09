import VueRouter from "vue-router";

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
        path: "/recipes",
        component: require("./components/Pages/Recipe/RecipesPage.vue"),
        meta: {
            title: "Rezepte - ReciPHP",
        },
    },
    {
        path: "/recipes/new",
        component: require("./components/Pages/Recipe/NewRecipePage.vue"),
        meta: {
            title: "Neues Rezept - ReciPHP",
        },
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

export default router;