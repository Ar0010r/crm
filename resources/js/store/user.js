import {container} from '../services/index'

export default {
    namespaced: true,
    state: {
        profile: {
            /*id: "",
            login: "",
            role: "",
            avatar: "",
            token: ""*/
        },

        users: {},
        hrs: {},
        personnels: {},
        roles: {},
    },
    mutations: {
        setProfile(state, user) {
            state.profile = user;
        },
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

            if (user.role === 'personnel') state.personnels[key] = user;
            if (user.role === 'hr') state.hrs[key] = user;
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
    actions: {
        async setProfileToStore({commit}) {
            try {
                let response = await container.UserService.getProfile();
                commit('setProfile', response.data);
            } catch (e) {
                dispatch('notification/activate', e.response.data, {root: true});
            }
        },

        async setUsersToStore({commit}, params) {
            try {
                let response = await container.UserService.getUsers(params);

                let usersList = response.data;

                let hrs = {};
                Object.keys(usersList).map(function (key) {
                    let index = usersList[key].id;
                    if (usersList[key].role === 'hr' || usersList[key].role === 'top hr') hrs[index] = usersList[key];
                });

                let personnels = {};
                Object.keys(usersList).map(function (key) {
                    let index = usersList[key].id;
                    if (usersList[key].role === 'personnel') personnels[index] = usersList[key];
                });

                let users = {};
                Object.keys(usersList).map(function (key) {
                    let index = usersList[key].id;
                    users[index] = usersList[key];
                });


                commit('setUsers', users);
                commit('setHrs', hrs);
                commit('setPersonnels', personnels);

            } catch (e) {
                dispatch('notification/activate', e.response.data, {root: true});
            }

        },

        async setRolesToStore({commit}) {
            try {
                let response = await container.UserService.getRoles();
                commit('setRoles', response.data);
            } catch (e) {
                dispatch('notification/activate', e.response.data, {root: true});
            }
        }


    }
}