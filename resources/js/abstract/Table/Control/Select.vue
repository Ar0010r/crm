<template>
    <div class="col-md mb-4">
        <label class="form-label">{{ title }}</label>
        <select class="custom-select" v-model="vmodel" @change="change" :class="{ 'light-grey': vmodel == nullValue}">
            <option :value=nullValue> Any </option>
            <option v-for="option in options" :value="option[value]">
                {{option[name]}}
            </option>
        </select>
    </div>
</template>

<script>
import {useStore} from "vuex";

export default {
    props: {
        title: String,
        options: Array | Object,
        value: {
            type: String,
            default: 'id'
        },
        name: {
            type: String,
            default: 'name'
        },
        vmodel: String,
        commit: String,
        param: String
    },
    setup(props) {
        const store = useStore();
        return {
            change : () =>  store.commit(props.commit, {'key': props.param, 'value': props.vmodel}),
            nullValue: null
        }
    }
};
</script>


<style lang="scss">
.light-grey{
    color: #babbbc
}
</style>
