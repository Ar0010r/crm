import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {},
        statistics: {},
        queryParams: {
            manager_id: null,
            type: null,
            search_term: null,
            created_before: null,
            created_after: null,
            take: 100,
            page: 1,
        },
        companyModel: {
            name: null,
            manager_id: null,
            manager: {login: null},
            domain: null,
            pseudonym: null,
            email: null,
            type: null,
            created_at: null,
            dataIsValid: null,
        },
        types: [
            {
                id: 0,
                name:'Delivery'
            },
            {
                id: 1,
                name:'Hiring'
            }
        ],
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        setData(state, companies) {
            state.data = companies;
        },
        setMeta(state, meta) {
            state.meta = meta;
        },
        setStatistics(state, statistics) {
            state.statistics = statistics;
        },
        set(state, company) {
            let key = company.id;
            if (state.companies[key]) {
                state.companies[key] = {...state.companies[key], ...company};

            } else {
                let newCompanyObj = {};
                newCompanyObj[key] = company;
                state.companies = {...newCompanyObj, ...state.companies};
            }
        },
        unset(state, id) {
            delete state.companies[id];
        },
    },
    actions: {
        async get({commit}, params) {
            try {
                let response = await container.CompanyService.get(params);
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if(e.response.status === 401) container.AuthService.logout()
            }
        },

        delete({commit, dispatch, state}, company) {
            let key = company.id;
            if (state.companies[key]) {
                commit('unset', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },
        async statistics({commit}, params) {
            try {
                let statistics = await container.CompanyService.statistics();

                commit('setStatistics', statistics.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
