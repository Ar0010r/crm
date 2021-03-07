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
        setCompanyById(state, company) {
            console.log('ffffffff', company);
            let key = company.id;
            if (state.companies[key]) {
                state.companies[key] = {...state.companies[key], ...company};

            } else {
                let newCompanyObj = {};
                newCompanyObj[key] = company;
                state.companies = {...newCompanyObj, ...state.companies};
            }

            console.log(state.companies);
        },
    },
    actions: {},
    modules: {}
}