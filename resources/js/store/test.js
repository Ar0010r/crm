import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        tests: {},
        envs: [
            'Web',
            'The Bat',
            'Thunderbird'
        ],
        templates: [
            'Welcome letter',
            'Hello',
            'Random'
        ],
        queryParams: {
            manager_id: "",
            company_id: "",
            env: "",
            template: "",
            take: 100,
            page: "",
        },
        emptyTest: {
            date: null,
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
            progress: null
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        async setTests(state, tests) {
            state.tests = tests;
        },
        setStatistics(state, statistics) {
            state.statistics = statistics;
        },
        setTestById(state, test) {
            let key = test.id;
            if (state.tests[key]) {
                state.tests[key] = {...state.tests[key], ...test};

            } else {
                let newTestObj = {};
                newTestObj[key] = test;
                state.tests = {...newTestObj, ...state.tests};
            }
        },
        deleteTestById(state, id) {
            delete state.tests[id];
        }
    },
    actions: {
        async setTestsToStore({commit, dispatch}, params) {
            try {
                let testsList = await container.TestService.get(params);
                testsList = testsList.data.list;

                let tests = {};
                Object.keys(testsList).map(function (key) {
                    let index = testsList[key].id;
                    tests[index] = testsList[key];
                });


                commit('setTests', tests);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        deleteTest({commit, dispatch, state}, test) {
            let key = test.id;
            if (state.tests[key]) {
                commit('deleteTestById', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async setStatisticsToStore({commit}, params) {
            try {
                let statisticts = await container.TestService.getStatistics();

                commit('setStatistics', statisticts.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
