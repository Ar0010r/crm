import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        controlled: {},
        hr: {},
        delivery: {},
        meta: {from: 0, to: 0, total: 0},
        queryParams: {
            manager_id: null,
            type: null,
            scam: null,
            status: null,
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
            scam: 'ok',
            status: 'in use',
            created_at: null,
            dataIsValid: null,
        },
        types: [
            {
                id: 0,
                name: 'Delivery'
            },
            {
                id: 1,
                name: 'Hiring'
            }
        ],
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
        setData(state, companies) {
            state.data = companies;
        },
        setMeta(state, meta) {
            state.meta = meta;
        },
        set(state, company) {
            let key = company.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...company};

            } else {
                let newCompanyObj = {};
                newCompanyObj[key] = company;
                state.data = {...newCompanyObj, ...state.data};
                state.meta.total = state.meta.total + 1
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
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async create({commit, dispatch, rootState}, model) {
            try {
                const profile = rootState.profile.profile;
                if (profile.role == 'hr' || profile.role == 'top hr') {
                    model.type = 1
                    model.manager_id = profile.id
                }
                if (profile.role == 'personnel') {
                    model.type = 0
                    model.manager_id = profile.id
                }
                let response = await container.CompanyService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch, state}, model) {
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
        }
    },
}
