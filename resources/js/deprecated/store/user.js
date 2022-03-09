import {container} from '../../services'
import {emitter} from '../../app';

export default {
    namespaced: true,
    state: {
        profile: {},
        users: {},
        managerModel:{
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
            state.profile.password = null;
        },
        setUsers(state, users) {
            state.managers = users;
        },
        setUserById(state, user) {
            console.log(user);
            let key = user.id;
            if (state.managers[key]) {
                state.managers[key] = {...state.managers[key], ...user};

            } else {
                let newUserObj = {};
                newUserObj[key] = user;
                state.managers = {...newUserObj, ...state.managers};
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
            delete state.managers[id];
        },

    },
    actions: {
        async setProfile({commit}) {
            try {
                let response = await container.ManagerService.profile();
                commit('setProfile', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async setUsersToStore({commit, dispatch, state}, params) {
            try {
                let response = await container.ManagerService.get(params);
                let users;
                if(state.profile.role !== 'top hr') {
                    users = response.data.list.filter(user => user.id !== state.profile.id)
                }
                users = response.data.list;

                dispatch('sort', users);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if(e.response.status === 401) container.AuthService.logout()
            }

        },

        async setRoles({commit}) {
            try {
                let response = await container.ManagerService.roles();
                commit('setRoles', response.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        deleteUser({commit, dispatch, state}, user) {
            let key = user.id;
            if (state.managers[key]) {
                commit('deleteUserById', key);
                dispatch('sort', state.managers);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async sort({commit, state}, data) {
            let users = container.ManagerService.sort(data);
            if(state.profile.role === 'top hr' || state.profile.role === 'admin' ) delete users.users[state.profile.id]

            commit('setUsers', users.users);
            commit('setHrs', users.hrs);
            commit('setPersonnels', users.personnels);
        },
    }
}
