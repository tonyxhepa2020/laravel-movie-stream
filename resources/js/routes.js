
import Vue from "vue";
import Router from "vue-router";

import AdminCast from "./components/admin/AdminCast";
import AdminEpisode from "./components/admin/AdminEpisode";
import AdminGenre from "./components/admin/AdminGenre";
import AdminMovie from "./components/admin/AdminMovie";
import AdminSerie from "./components/admin/AdminSerie";
import AdminTag from "./components/admin/AdminTag";
import Dashboard from "./components/admin/Dashboard";
import AdminSeason from "./components/admin/AdminSeason";
import AdminSetting from "./components/admin/AdminSetting";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {   path: '/admin',
            name: "Dashboard",
            component: Dashboard
        },
        {   path: '/admin/cast',
            name: "AdminCast",
            component: AdminCast
        },
        {   path: '/admin/genre',
            name: "AdminGenre",
            component: AdminGenre
        },
        {   path: '/admin/movie',
            name: "AdminMovie",
            component: AdminMovie
        },
        {   path: '/admin/serie',
            name: "AdminSerie",
            component: AdminSerie
        },
        {   path: '/admin/serie/:serieId/seasons',
            name: "AdminSeason",
            component: AdminSeason
        },
        {   path: '/admin/serie/:serieId/season/:seasonId/epsode',
            name: "AdminEpisode",
            component: AdminEpisode
        },
        {   path: '/admin/tag',
            name: "AdminTag",
            component: AdminTag
        },
        {   path: '/admin/setting',
            name: "AdminSetting",
            component: AdminSetting
        },

    ],
});
