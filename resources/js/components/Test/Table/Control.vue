<template>
    <Control getter="getTestQueryParams" dispatch="test/get" commit="test/setQueryParam">
        <Button title="Add test" event="create-test-form" target="#createTestForm" getter="getTestModel"/>
        <Select title="Company"
                :vmodel=filters.company_id
                :options="companies"
                name="name"
                commit="test/setQueryParam"
                param="company_id"
        >
        </Select>
        <Select
            v-if="profileIsAdmin"
            title="Manager"
            :vmodel=filters.manager_id
            :options="managers"
            name="login"
            commit="test/setQueryParam"
            param="manager_id"
        ></Select>
        <Select
            title="Env"
            :vmodel=filters.env
            :options="envs()"
            commit="test/setQueryParam"
            param="env"
        ></Select>
        <Select
            title="Template"
            :vmodel=filters.template
            :options="templates()"
            commit="test/setQueryParam"
            param="template"
        ></Select>
        <DatePicker
            title="Tested after"
            :vmodel=filters.date_after
            param="date_after"
            commit="test/setQueryParam"
        />
        <DatePicker
            title="Tested before"
            :vmodel=filters.date_before
            param="date_before"
            commit="test/setQueryParam"
        />
    </Control>
</template>

<script>
import Control from '../../../abstract/Table/Control/Control';
import Select from '../../../abstract/Table/Control/Select';
import Button from '../../../abstract/Table/Control/Button';
import DatePicker from '../../../abstract/Table/Control/DatePicker';
import {useStore} from "vuex";
import {computed, inject} from "vue";

export default {
    setup() {
        const store = useStore();
        const container = inject('container')

        return {
            companies: computed(() => container.CompanyService.controlled(
                store.getters.getCompanies, store.getters.getProfile
            )),
            managers: computed(() => store.getters.getManagers),
            filters: computed(() => store.getters.getTestQueryParams),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
            envs: function () {
                return store.getters.getEnvs.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            },
            templates: function () {
                return store.getters.getTemplates.map(function (value) {
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
