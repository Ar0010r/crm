import {createWebHistory, createRouter, useRoute} from 'vue-router';
import axios from "axios";

const EmployeesView = () => import('./views/EmployeesView.vue');
const CompaniesView = () => import('./views/CompaniesView.vue');
const ManagersView = () => import('./views/ManagersView.vue');
const LoginView = () => import('./views/LoginView.vue');

const history = createWebHistory();

const router = createRouter({
    history,
    routes: [
        {
            path: '/employees',
            component: EmployeesView,
            name: 'employees-table'
        },
        {
            path: '/managers',
            component: ManagersView,
            name: 'managers-table'
        },
        {
            path: '/companies',
            component: CompaniesView,
            name: 'companies-table'
        },
        {
            path: '/login',
            component: LoginView,
            name: 'login'
        },
        {
            path: '/',
            redirect: '/employees'
        }
    ],
    linkActiveClass: "active", // active class for non-exact links.
    linkExactActiveClass: "active" // active class for *exact* links.
});

router.beforeEach((to, from, next) => {
    if (localStorage.getItem('token')) {
         //useStore().state.user.token = localStorage.getItem('token');
         axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        if (to.name === 'login') {
            next("/employees");
        } else {
            next();
        }
    } else {
        if (to.name === 'login') {
            next()
        } else {
            next("/login")
        }
    }
});

export default router;