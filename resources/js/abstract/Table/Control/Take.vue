<template>
    <div class="dataTables_length">
        <label>Show
            <select class="custom-select custom-select-sm form-control form-control-sm"
                    v-model="vmodel"
                    @change="take"
            >
                <option value=100>100</option>
                <option value=200>200</option>
                <option value=300>300</option>
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
            props.vmodel = 100
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
                await store.commit(props.namespace + "/setQueryParam", {'key': 'take', 'value': take})
                console.log('props.getter', props.getter)
            }
        }
    },
    props: {
        vmodel: String | Number,
        getter: String,
        namespace: String,
    },
};
</script>
