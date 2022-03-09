<template>
    <div class="dataTables_filter">
        <label>Search:
            <input type="search" v-model="vmodel"
                   class="form-control form-control-sm"
                   v-on:keyup.enter="search"
                   placeholder="Search"
                   aria-controls="user-list">
        </label>
    </div>
</template>

<script>
import {useStore} from 'vuex';

export default {

    setup(props) {
        const store = useStore();

        return {
            search: async function () {
                let search = props.vmodel
                let filters = store.getters[props.getter]
                let queryParams = {};
                Object.keys(filters).map(function (key) {
                    if (filters[key]) {
                        return  queryParams[key] = filters[key];
                    }
                })
                queryParams.search_term = search;
                await store.dispatch(props.namespace + "/get", queryParams);
                store.commit(props.namespace + "/setQueryParam", {'key': 'search_term', 'value': search})
            }
        }
    },
    props: {
        vmodel: String,
        getter: String,
        namespace: String,
    },
};
</script>
