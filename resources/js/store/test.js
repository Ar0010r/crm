import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {from: 0, to: 0, total: 0},
        envs: [
            'Web',
            'The Bat',
            'Thunderbird'
        ],
        templates: [
            'Link',
            'File',
            'Hello',
            'Random'
        ],
        queryParams: {
            manager_id: null,
            company_id: null,
            env: null,
            template: null,
            search_term: null,
            take: 100,
            page: 1,
        },
        testModel: {
            manager_id: null,
            manager: {login: null},
            company_id: null,
            company: {name: null},
            env: null,
            template: null,
            google: null,
            yahoo: null,
            outlook: null,
            other: null,
            date_after: null,
            date_before: null,
            date: function () {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                let yyyy = today.getFullYear();
                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return yyyy + '-' + mm + '-' + dd;
            }()
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },

        setData(state, tests) {
            state.data = tests;
        },

        setMeta(state, meta) {
            state.meta = meta;
        },
        set(state, test) {
            let key = test.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...test};

            } else {
                let newTestObj = {};
                newTestObj[key] = test;
                state.data = {...newTestObj, ...state.data};
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
                let response = await container.TestService.get(params);
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async create({commit, dispatch}, model) {
            try {
                let response = await container.TestService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                let response = await container.TestService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async delete({commit, dispatch, state}, test) {
            let id = test.id;
            if (state.data[id]) {
                await container.TestService.delete(test)
                commit('unset', id);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },
    },
}
