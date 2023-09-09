<template>
    <Control getter="getConversionQueryParams" dispatch="conversion/get" commit="conversion/setQueryParam">
        <Select
            title="Manager"
            :vmodel=filters.manager_id
            :options="managers"
            name="login"
            commit="conversion/setQueryParam"
            param="manager_id"
        ></Select>
        <Select
            title="Status"
            :vmodel=filters.status
            :options="statuses"
            commit="conversion/setQueryParam"
            param="status"
        ></Select>
        <Select
            title="Scam"
            :vmodel=filters.scam
            :options="scam"
            commit="conversion/setQueryParam"
            param="scam"
        ></Select>
        <DatePicker
            title="Created after"
            :vmodel=filters.created_from
            param="created_from"
            commit="conversion/setQueryParam"
        />
        <DatePicker
            title="Created before"
            :vmodel=filters.created_to
            param="created_to"
            commit="conversion/setQueryParam"
        />
    </Control>
</template>

<script>
import Control from '../../abstract/Table/Control/Control';
import Select from '../../abstract/Table/Control/Select';
import DatePicker from '../../abstract/Table/Control/DatePicker';
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    setup() {
        const store = useStore();
        return {
            managers: computed(() => store.getters.getManagers),
            filters: computed(() => store.getters.getConversionQueryParams),
            types: store.getters.getTypes,
            statuses: store.getters.getCompanyStatuses,
            scam: store.getters.getCompanyScam,
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
        }
    },
    components: {
        DatePicker,
        Control,
        Select
    }
};
</script>
