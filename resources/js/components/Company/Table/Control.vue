<template>
    <Control getter="getCompanyQueryParams" dispatch="company/get" commit="company/setQueryParam">
        <Button title="Add company" event="create-company-form" target="#createCompanyForm" getter="getCompanyModel"/>
        <Select
            v-if="profileIsAdmin"
            title="Manager"
            :vmodel=filters.manager_id
            :options="managers"
            name="login"
            commit="company/setQueryParam"
            param="manager_id"
        ></Select>
        <Select
            title="Type"
            :vmodel=filters.type
            :options="types"
            commit="company/setQueryParam"
            param="type"
        ></Select>
        <DatePicker
            title="Created after"
            :vmodel=filters.created_after
            param="created_after"
            commit="company/setQueryParam"
        />
        <DatePicker
            title="Created before"
            :vmodel=filters.created_before
            param="created_before"
            commit="company/setQueryParam"
        />
    </Control>
</template>

<script>
import Control from '../../../abstract/Table/Control/Control';
import Select from '../../../abstract/Table/Control/Select';
import Button from '../../../abstract/Table/Control/Button';
import DatePicker from '../../../abstract/Table/Control/DatePicker';
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    setup() {
        const store = useStore();
        return {
            managers: computed(() => store.getters.getManagers),
            filters: computed(() => store.getters.getCompanyQueryParams),
            types: store.getters.getTypes,
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
        }
    },
    components: {
        DatePicker,
        Control,
        Select,
        Button,
    }
};
</script>
