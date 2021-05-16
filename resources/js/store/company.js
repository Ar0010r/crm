import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        companies: {},
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
                companiesList = companiesList.data;

                let companies = {};
                Object.keys(companiesList).map(function (key) {
                    let index = companiesList[key].id;
                    companies[index] = companiesList[key];
                });

                commit('setCompanies', companies);
            } catch (e) {
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
    },
}