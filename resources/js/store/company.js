import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        companies: {},
        statistics: {},
        queryParams: {
            page: "",
            manager_id: "",
            type: "",
            take: 100
        },
        emptyCompany: {
            name: null,
            manager_id: null,
            manager: {login: null},
            domain: null,
            pseudonym: null,
            email: null,
            type: null,
            created_at: null,
            dataIsValid: null,
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        async setCompanies(state, companies) {
            state.companies = companies;
        },
        setStatistics(state, statistics) {
            state.statistics = statistics;
        },
        setCompanyById(state, company) {
            let key = company.id;
            if (state.companies[key]) {
                state.companies[key] = {...state.companies[key], ...company};

            } else {
                let newCompanyObj = {};
                newCompanyObj[key] = company;
                state.companies = {...newCompanyObj, ...state.companies};
            }
        },
        deleteCompanyById(state, id) {
            delete state.companies[id];
        },
    },
    actions: {
        async setCompaniesToStore({commit}, params) {
            try {
                console.log(111111, params)
                let companiesList = await container.CompanyService.getCompanies(params);
                companiesList = companiesList.data.list;

                let companies = {};
                Object.keys(companiesList).map(function (key) {
                    let index = companiesList[key].id;
                    companies[index] = companiesList[key];
                });

                commit('setCompanies', companies);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if(e.response.status === 401) container.AuthService.logout()
            }
        },

        deleteCompany({commit, dispatch, state}, company) {
            let key = company.id;
            if (state.companies[key]) {
                commit('deleteCompanyById', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },
        async setStatisticsToStore({commit}, params) {
            try {
                let statistics = await container.CompanyService.getStatistics();

                commit('setStatistics', statistics.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
