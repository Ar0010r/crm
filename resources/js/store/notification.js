export default {
    namespaced: true,
    state: {
        show: false,
        message: "",
    },
    mutations: {
        setShow(state, show) {
            state.show = show
        },
        setMessage(state, message) {
            state.message = message
        },
    },

    actions: {
        async activate({commit, dispatch}, message) {
            document.getElementById('growls-tr').classList.remove('d-none');
            setTimeout(() => {
                commit('notification/setMessage', message, {root: true});
                commit('notification/setShow', true, {root: true});
            }, 100)

            setTimeout(() => {
                dispatch('deactivate');
            }, 5000)

        },

        async deactivate({commit}) {
            commit('notification/setShow', false, {root: true});

            setTimeout(() => {
                commit('notification/setMessage', "", {root: true});
                document.getElementById('growls-tr').classList.add('d-none')
            }, 300)

        }
    }
}
