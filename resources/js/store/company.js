import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {from: 0, to: 0, total: 0},
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
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...company};

            } else {
                let newCompanyObj = {};
                newCompanyObj[key] = company;
                state.data = {...newCompanyObj, ...state.data};
            }
        },
        unset(state, id) {
            delete state.data[id];
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

        async create({commit, dispatch}, model) {
            try {
                let response = await container.CompanyService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                let response = await container.CompanyService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async delete({commit, dispatch, state}, company) {
            let key = company.id;
            if (state.data[key]) {
                await container.CompanyService.delete(company)
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
