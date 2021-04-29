import {container} from '../services/index'

export default {
    namespaced: true,
    state: {
        companies: {},
        emptyCompany: {
            name: null,
            personnel_id: null,
            personnel: {login: null},
            domain: null,
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
                dispatch('notification/activate', e.response.data, {root: true});
            }
        }
    },
}