import {createWebHistory, createRouter} from 'vue-router';
import store from './store'
import axios from "axios";

const EmployeesView = () => import('./views/EmployeesView.vue');
const CompaniesView = () => import('./views/CompaniesView.vue');
const ManagersView = () => import('./views/ManagersView.vue');
const LoginView = () => import('./views/LoginView.vue');
const LettersView = () => import('./views/LettersView.vue');
const StatisticsView = () => import('./views/StatisticsView.vue');
const TestsView = () => import('./views/TestsView.vue');

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
            path: '/mails',
            component: LettersView,
            name: 'mails-table',
            meta: {title: 'mails'}
        },
        {
            path: '/login',
            component: LoginView,
            name: 'login',
            meta: {title: 'login'}
        },
        {
            path: '/statistics',
            component: StatisticsView,
            name: 'statistics',
            meta: {title: 'statistics'}
        },
        {
            path: '/tests',
            component: TestsView,
            name: 'tests',
            meta: {title: 'tests'}
        },
        {
            path: '/',
            redirect: '/employees'
        },
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

router.beforeEach(async (to, from, next) => {
    document.title = to.meta.title;

    if (!to.matched.length) return next('/employees');
    const tokenIsOk = axios.defaults.headers.common['Authorization'] === 'Bearer ' + localStorage.getItem('token');

    if (tokenIsOk && to.name !== 'login') return next();
    if (tokenIsOk && to.name === 'login') return next("/employees");

    if (localStorage.getItem('token')) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        let profileIsUndefined = Object.keys(store.getters.getProfile).length === 0;
        if (profileIsUndefined) await store.dispatch('user/setProfileToStore');
        const profile = store.getters.getProfile;


        if(to.name !== 'managers' && (profile.role === 'hr' || profile.role === 'personnel')) return next("/employees")

        if (to.name === 'login') return next("/employees");
        next();
    } else {
        if (to.name === 'login') return next();
        next("/login")
    }
});

export default router;
