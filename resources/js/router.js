import {createWebHistory, createRouter} from 'vue-router';
import store from './store'
import axios from "axios";

const ApplicantsView = () => import('./views/ApplicantsView.vue');
const CompaniesView = () => import('./views/CompaniesView.vue');
const ManagersView = () => import('./views/ManagersView.vue');
const LoginView = () => import('./views/LoginView.vue');
const MailsView = () => import('./views/MailsView.vue');
const StatisticsView = () => import('./views/StatisticsView.vue');
const TestsView = () => import('./views/TestsView.vue');
const SubscriptionsView = () => import('./views/SubscriptionsView.vue');

const history = createWebHistory();

const router = createRouter({
    history,
    routes: [
        {
            path: '/applicants',
            component: ApplicantsView,
            name: 'applicants-table',
            meta: {title: 'applicants'}
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
            component: MailsView,
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
            path: '/subscriptions',
            component: SubscriptionsView,
            name: 'subscriptions',
            meta: {title: 'subscriptions'}
        },
        {
            path: '/',
            redirect: '/applicants'
        },
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

router.beforeEach(async (to, from, next) => {
    document.title = to.meta.title;

    if (!to.matched.length) return next('/applicants');
    const tokenIsOk = axios.defaults.headers.common['Authorization'] === 'Bearer ' + localStorage.getItem('token');

    if (tokenIsOk && to.name !== 'login') return next();
    if (tokenIsOk && to.name === 'login') return next("/applicants");

    if (localStorage.getItem('token')) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        let profileIsUndefined = Object.keys(store.getters.getProfile).length === 0;
        //if (profileIsUndefined) await store.dispatch('manager/setProfile');
        if (profileIsUndefined) await store.dispatch('profile/get');
        const profile = store.getters.getProfile;


        if(to.name !== 'managers' && (profile.role === 'hr' || profile.role === 'personnel')) return next("/applicants")

        if (to.name === 'login') return next("/applicants");
        next();
    } else {
        if (to.name === 'login') return next();
        next("/login")
    }
});

export default router;
