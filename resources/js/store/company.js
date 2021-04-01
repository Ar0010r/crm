import {createStore} from "vuex";
import { container } from '../services/index'

export default {
    namespaced: true,
    state: {
        companies: {},
    },
    getters: {
       // getCompanies: state => state.companies,
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
        async setCompaniesToStore({ commit }){
            let companiesList = await container.CompanyService.getCompanies();
            companiesList = companiesList.data;

            let companies = {};
            Object.keys(companiesList).map(function (key) {
                let index = companiesList[key].id;
                companies[index] = companiesList[key];
            });

            commit('setCompanies', companies);
        }
    },
    modules: {}
}