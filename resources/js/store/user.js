import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        profile: {},
        users: {},
        emptyUser:{
            created_at:"",
            deleted_at: "",
            login: "",
            role: "",
            updated_at: "",
            password: null
        },
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

        deleteUserById(state, id) {
            delete state.users[id];
        },

    },
    actions: {
        async setProfileToStore({commit}) {
            try {
                let response = await container.UserService.getProfile();
                commit('setProfile', response.data);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async setUsersToStore({commit, dispatch}, params) {
            try {
                let response = await container.UserService.getUsers(params);

                dispatch('sort', response.data);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if(e.response.status === 401) container.AuthService.logout()
            }

        },

        async setRolesToStore({commit}) {
            try {
                let response = await container.UserService.getRoles();
                commit('setRoles', response.data);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        deleteUser({commit, dispatch, state}, user) {
            let key = user.id;
            if (state.users[key]) {
                commit('deleteUserById', key);
                dispatch('sort', state.users);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async sort({commit}, data) {
            let users = container.UserService.sort(data);

            commit('setUsers', users.users);
            commit('setHrs', users.hrs);
            commit('setPersonnels', users.personnels);
        },
    }
}