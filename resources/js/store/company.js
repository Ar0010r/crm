import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        companies: {},
        statistics: {},
        emptyCompany: {
            name: null,
            personnel_id: null,
            personnel: {login: null},
            domain: null,
            pseudonym: null,
            email: null,
            created_at: null,
            dataIsValid: null,
        }
    },
    mutations: {
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
        async setCompaniesToStore({commit, dispatch}) {
            try {
                let companiesList = await container.CompanyService.getCompanies();
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
                let employees = await container.CompanyService.getStatistics();

                commit('setStatistics', employees.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },
    },
}
