import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {from: 0, to: 0, total: 0},
        providers: [
            'Google',
            'Outlook',
            'Namecheap',
            'Megahoster',
            'Warmup Inbox',
        ],
        services: [
            'Email',
            'Hosting',
            'Warmup',
        ],
        periods: [
            'monthly',
            'quarterly',
            'half-yearly',
            'yearly',
        ],
        statuses: [
            'in use',
            'terminated',
        ],
        queryParams: {
            company_id: null,
            provider: null,
            service: null,
            paid_before: null,
            paid_after: null,
            search_term: null,
            status: null,
            take: 100,
            page: 1,
        },
        subscriptionModel: {
            company_id: null,
            company: {name: null},
            provider: null,
            service: null,
            price: null,
            period: null,
            status: 'in use',
            last_payment: function () {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                let yyyy = today.getFullYear();
                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return  yyyy + '-' + mm + '-' + dd;
            }()
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },

        setData(state, subscriptions) {
            state.data = subscriptions;
        },

        setMeta(state, meta) {
            state.meta = meta;
        },
        set(state, subscription) {
            let key = subscription.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...subscription};

            } else {
                let newSubscriptionObj = {};
                newSubscriptionObj[key] = subscription;
                state.data = {...newSubscriptionObj, ...state.data};
                state.meta.total = state.meta.total + 1
            }
        },
        unset(state, id) {
            delete state.data[id];
        }
    },
    actions: {
        async get({commit, dispatch}, params) {
            try {
                let response = await container.SubscriptionService.get(params);
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async create({commit, dispatch}, model) {
            try {
                let response = await container.SubscriptionService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                let response = await container.SubscriptionService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async delete({commit, dispatch, state}, subscription) {
            let id = subscription.id;
            if (state.data[id]) {
                await container.SubscriptionService.delete(subscription)
                commit('unset', id);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },
    },
}
