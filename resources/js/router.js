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
        },
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

router.beforeEach((to, from, next) => {
    const tokenIsOk =  axios.defaults.headers.common['Authorization'] === 'Bearer ' + localStorage.getItem('token');

    if(tokenIsOk && to.name !== 'login') next();
    if(tokenIsOk && to.name === 'login') next("/employees");

    if (localStorage.getItem('token')) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        let profileIsUndefined = Object.keys(store.getters.getProfile).length === 0;
        if (profileIsUndefined) store.dispatch('user/setProfileToStore');

        if (to.name === 'login') next("/employees");
        else next();
    } else {
        if (to.name === 'login') next()
        else next("/login")
    }
});

export default router;