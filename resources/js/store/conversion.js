import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        hr: {},
        meta: {from: 0, to: 0, total: 0},
        queryParams: {
            manager_id: null,
            scam: null,
            status: null,
            search_term: null,
            created_to: null,
            created_from: null,
            take: 2,
            page: 1,
        },
        statuses: [
            {
                id: 'in use',
                name: 'in use'
            },
            {
                id: 'terminated',
                name: 'terminated'
            }
        ],
        scam: [
            {
                id: 'ok',
                name: 'ok'
            },
            {
                id: 'scam',
                name: 'scam'
            }
        ],
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        setData(state, data) {
            state.data = data;
        },
        setMeta(state, meta) {
            state.meta = meta;
        },
    },
    actions: {
        async get({commit}, params) {
            try {
                let response = await container.CompanyService.conversion(params);
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
