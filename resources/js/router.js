import {createWebHistory, createRouter} from 'vue-router';
import store from './store'
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
            name: 'employees-table',
            meta: {title: 'employees'}
        },
        {
            path: '/managers',
            component: ManagersView,
            name: 'managers-table',
            meta: {title: 'managers'}
        },
        {
            path: '/companies',
            component: CompaniesView,
            name: 'companies-table',
            meta: {title: 'companies'}
        },
        {
            path: '/login',
            component: LoginView,
            name: 'login',
            meta: {title: 'login'}
        },
        {
            path: '/',
            redirect: '/employees'
        },
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    const tokenIsOk = axios.defaults.headers.common['Authorization'] === 'Bearer ' + localStorage.getItem('token');

    if (tokenIsOk && to.name !== 'login') return next();
    if (tokenIsOk && to.name === 'login') return next("/employees");

    if (localStorage.getItem('token')) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        let profileIsUndefined = Object.keys(store.getters.getProfile).length === 0;
        if (profileIsUndefined) store.dispatch('user/setProfileToStore');

        if (to.name === 'login') return next("/employees");
        next();
    } else {
        if (to.name === 'login') return next();
        next("/login")
    }
});

export default router;