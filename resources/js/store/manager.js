import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        profile: {},
        data: {},
        meta: {},
        managerModel: {
            created_at: null,
            deleted_at: null,
            login: null,
            role: null,
            created_before: null,
            created_after: null,
            updated_at: null,
            password: null
        },
        hrs: {},
        personnels: {},
        roles: [],
        queryParams: {
            company_id: null,
            role: null,
            search_term: null,
            take: 100,
            page: 1,
        },
    },
    mutations: {
        setProfile(state, manager) {
            state.profile = manager;
            state.profile.password = null;
        },
        setData(state, data) {
            state.data = data;
        },
        setMeta(state, meta) {
            state.meta = meta;
        },
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        set(state, manager) {
            let key = manager.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...manager};

            } else {
                let newManagerObj = {};
                newManagerObj[key] = manager;
                state.data = {...newManagerObj, ...state.data};
            }

            if (manager.role === 'personnel') state.personnels[key] = manager;
            if (manager.role === 'hr') state.hrs[key] = manager;
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

        unset(state, id) {
            delete state.data[id];
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

        async setRoles({commit}) {
            try {
                let response = await container.ManagerService.roles();
                commit('setRoles', response.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async get({commit, dispatch, state}, params) {
            try {
                let response = await container.ManagerService.get(params);

                dispatch('sort', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                console.log(e);
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }

        },

        async create({commit, dispatch}, model) {
            try {
                let response = await container.ManagerService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                let response = await container.ManagerService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        delete({commit, dispatch, state}, manager) {
            let key = manager.id;
            if (state.data[key]) {
                container.ManagerService.delete(test)
                commit('unset', key);
                dispatch('sort', state.data);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async sort({commit, state}, data) {
            let managers = container.ManagerService.sort(data);
            if (state.profile.role === 'top hr' || state.profile.role === 'admin') delete data[state.profile.id]

            commit('setData', managers.managers);
            commit('setHrs', managers.hrs);
            commit('setPersonnels', managers.personnels);
        },
    }
}
