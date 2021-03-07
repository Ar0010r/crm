import {createStore} from "vuex";
import md5 from "js-md5";

export default {
    namespaced: true,
    state: {
        user: {
            id: "",
            login: "",
            token: ""
        },

        users : {},
        hrs : {},
        personnels : {},
        roles : {},
    },
    mutations: {
        setUsers(state, users) {
            state.users = users;
        },
        setUserById(state, user) {
            console.log(user);
            let key = user.id;
            if (state.users[key]) {
                state.users[key] = {...state.users[key], ...user};

            } else {
                let newUserObj = {};
                newUserObj[key] = user;
                state.users = {...newUserObj, ...state.users};
            }

            if(user.role === 'personnel') state.personnels[key] = user;
            if(user.role === 'hr') state.hrs[key] = user;


            console.log(state.users);
        },
        setRoles(state, roles) {
            state.roles = roles;
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