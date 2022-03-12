<template>
    <Control getter="getManagerQueryParams" dispatch="manager/get" commit="manager/setQueryParam">
        <Button title="Add manager" event="create-manager-form" target="#createManagerForm" getter="getManagerModel"/>
        <Select
            title="Role"
            :vmodel=filters.role
            :options="roles()"
            commit="manager/setQueryParam"
            param="role"
        />
        <Select title="Company"
                :vmodel=filters.company_id
                :options="companies"
                name="name"
                commit="manager/setQueryParam"
                param="company_id"
        />
        <DatePicker
            title="Hired after"
            :vmodel=filters.created_after
            param="created_after"
            commit="manager/setQueryParam"
        />
        <DatePicker
            title="Hired before"
            :vmodel=filters.created_before
            param="created_before"
            commit="manager/setQueryParam"
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
            companies: computed(() => store.getters.getCompanies),
            filters: computed(() => store.getters.getManagerQueryParams),
            roles: function () {
                return store.getters.getRoles.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            }
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
