<template>
    <div class="dataTables_length">
        <label>Show
            <select class="custom-select custom-select-sm form-control form-control-sm"
                    v-model="vmodel"
                    @change="take"
            >
                <option v-for="value in values" :value="value">{{value}}</option>
            </select>
            records
        </label>
    </div>
</template>

<script>
import {useStore} from 'vuex';
import {inject, watch, computed, onBeforeUnmount} from 'vue'

export default {

    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");

        function reset() {
            store.commit(props.namespace + "/setQueryParam", {'key': 'take', 'value': 100})
        }

        emitter.on('reset-controls', reset);
        onBeforeUnmount(() => emitter.off('reset-controls', reset));

        return {
            take: async function () {
                let take = props.vmodel
                let filters = store.getters[props.getter]
                let queryParams = {};
                Object.keys(filters).map(function (key) {
                    if (filters[key]) {
                        return  queryParams[key] = filters[key];
                    }
                })
                queryParams.take = take;
                await store.dispatch(props.namespace + "/get", queryParams);
                store.commit(props.namespace + "/setQueryParam", {'key': 'take', 'value': take})
            }
        }
    },
    props: {
        vmodel: String | Number,
        getter: String,
        namespace: String,
        values : {
            type: Array,
            default : [50, 100, 200, 300]
        }
    },
};
</script>
