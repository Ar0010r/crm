import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        profile: {},
        model: {
            login: null,
            file: null,
            password: null
        }
    },
    mutations: {
        set(state, manager) {
            state.profile = manager;
            state.profile.password = null;
        },
    },
    actions: {
        async get({commit}) {
            try {
                let response = await container.AuthService.profile();
                let profile = response.data.model;
                profile.file = null;

                commit('set', profile);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, user) {
            try {
                if (user.password === null) delete user.password;

                let formData = new FormData();
                if (user.file) formData.set('file', user.file);
                if (user.password) formData.set('password', user.password);

                formData.append('id', user.id);
                formData.append('login', user.login);
                formData.set('_method', 'put');
                await container.ManagerService.update(formData);
                dispatch('get')
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },
    }
}
