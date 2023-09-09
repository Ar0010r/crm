import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        data: {
            daily: [],
            total: [],
            hr: [],
            today: []
        },
        hr: {},
        meta: {from: 0, to: 0, total: 0},
        queryParams: {
            daily_from: null,
            daily_to: null,
            daily_hrs:[],
            total_from: null,
            total_to: null,
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            console.log(555, key, value);
            state.queryParams[key] = value
        },
        setData(state, data) {
            state.data = data;
            console.log(123456, data)
        },
        setDaily(state, data) {
            state.data.daily = data;
        },
        setTotal(state, data) {
            state.data.total = data;
        },
        setToday(state, data) {
            state.data.today = data;
        },
        setHr(state, data) {
            state.data.hr = data;
        }
    },
    actions: {
        async getDaily({commit}, params) {
            try {
                let response = await container.AnalyticsService.getDaily(params);

                commit('setDaily', response);
               // commit('setMeta', response.meta);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
        async getTotal({commit}, params) {
            try {
                let response = await container.AnalyticsService.getTotal(params);

                commit('setTotal', response.total);
                commit('setHr', response.hr);
                // commit('setMeta', response.meta);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async getToday({commit}, params) {
            try {
                let response = await container.AnalyticsService.getToday();

                commit('setToday', response);
                // commit('setMeta', response.meta);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
