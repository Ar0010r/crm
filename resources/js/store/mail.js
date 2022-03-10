import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {from: 0, to: 0, total: 0},
        statistics: {},
        queryParams: {
            hr_id: null,
            company_id: null,
            received_before: null,
            received_after: null,
            take: 100,
            page: 1,
        },
        mailModel: {
            hr_id: null,
            hr: {login: null},
            company_id: null,
            company: {name: null},
            google: 0,
            yahoo: 0,
            outlook: 0,
            other: 0,
            processed: 0,
            received_at: function () {
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

        setData(state, mails) {
            state.data = mails;
        },

        setMeta(state, meta) {
            state.meta = meta;
        },
        setStatistics(state, statistics) {
            state.statistics = statistics;
        },
        set(state, mail) {
            let key = mail.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...mail};

            } else {
                let newTestObj = {};
                newTestObj[key] = mail;
                state.data = {...newTestObj, ...state.data};
            }
        },
        unset(state, id) {
            delete state.data[id];
        }
    },
    actions: {
        async get({commit, dispatch}, params) {
            try {
                let response = await container.MailService.get(params);
                console.log('response.data', response.data)
                console.log('response.meta', response.meta)
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async create({commit, dispatch}, model) {
            try {
                let response = await container.MailService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                let response = await container.MailService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async delete({commit, dispatch, state}, mail) {
            let id = mail.id;
            if (state.data[id]) {
                await container.MailService.delete(mail)
                commit('unset', id);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async statistics({commit}, params) {
            try {
                let statisticts = await container.MailService.statistics();

                commit('setStatistics', statisticts.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
