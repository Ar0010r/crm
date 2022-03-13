<template>
    <div class="ui-bordered px-4 pt-4 mb-4">
        <div class="form-row align-items-center">
            <div class="col-auto mb-4">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button class="btn btn-secondary" type="button" title="Refresh" @click="reset">
                    <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
                </button>
            </div>

            <slot></slot>

            <div class="col-md col-xl-2 mb-4">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button type="button" class="btn btn-secondary btn-block" @click="submit">Show</button>
            </div>
        </div>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {inject} from "vue";

export default {
    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");

        return {
            reset: function () {
                let filters = store.getters[props.getter]
                Object.keys(filters).map(function (key) {
                    if (key in filters && filters[key] !== "take" && filters[key] !== "page") {
                        store.commit(props.commit, {'key': key, 'value': null})
                    }
                    store.commit(props.commit, {'key': "take", 'value': 100})
                    store.commit(props.commit, {'key': "page", 'value': 1})
                    store.commit(props.commit, {'key': "search_term", 'value': null})
                })
                store.dispatch(props.dispatch);
                emitter.emit('reset-controls')
            },
            submit: function () {
                let filters = store.getters[props.getter]
                let queryParams = {};
                Object.keys(filters).map(function (key) {
                    if (filters[key] != null) {
                        return  queryParams[key] = filters[key];
                    }
                })
                store.dispatch(props.dispatch, queryParams);
            }
        }
    },
    props: {
        getter: String,
        dispatch: String,
        commit: String,
    },
};
</script>
