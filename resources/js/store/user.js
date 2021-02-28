import {createStore} from "vuex";

export default {
    namespaced: true,
    state: {
        user: {
            id: "",
            login: "",
            token: ""
        },

        users:{},
        hrs:{},
        personnels:{},
    },
    mutations: {
        setUsers(state, users) {
            state.users = users;
        },
        setHrs(state, hrs) {
            state.hrs = hrs;
        },
        setPersonnels(state, personnels) {
            state.personnels = personnels;
        },

    },
    actions: {},
    modules: {}
}