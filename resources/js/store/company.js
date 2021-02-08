import {createStore} from "vuex";

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
    },
    actions: {},
    modules: {}
}