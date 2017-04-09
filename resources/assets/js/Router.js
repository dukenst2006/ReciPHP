import VueRouter from "vue-router";

const routes = [
    {
        path: "/home",
        component: require("./components/Pages/HomePage.vue"),
        meta: {
            title: "Home - ReciPHP",
        },
    },
    {
        path: "/recipes",
        component: require("./components/Pages/RecipesPage.vue"),
        meta: {
            title: "Rezepte - ReciPHP",
        },
    },
    {
        path: "/users",
        component: require("./components/Pages/UsersPage.vue"),
        meta: {
            title: "Users - ReciPHP",
        },
    },
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