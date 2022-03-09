<template>
    <Control getter="getApplicantQueryParams" dispatch="applicant/get" commit="applicant/setQueryParam">
        <Button
            v-if="!profileIsPersonnel"
            title="Create"
            event="create-applicant-form"
            target="#createApplicantForm"
            getter="getApplicantModel"
        />
        <Button
            v-if="!profileIsPersonnel"
            title="Import"
            event="file-input-form"
            target="#fileInputForm"/>

        <Select title="Company"
                :vmodel=filters.company_id
                :options="companies"
                name="name"
                commit="applicant/setQueryParam"
                param="company_id"
        />
        <Select
            v-if="profileIsAdmin"
            title="Hr"
            :vmodel=filters.hr_id
            :options="hrs"
            name="hr"
            commit="applicant/setQueryParam"
            param="manager_id"
        />
        <ContactedSelect v-if="!profileIsPersonnel"/>
        <Select
            title="Status"
            :vmodel=filters.status
            :options="statuses()"
            param="status"
            commit="applicant/setQueryParam"
        />
        <DatePicker
            title="Applied before"
            :vmodel=filters.created_before
            param="created_before"
            commit="applicant/setQueryParam"
        />
        <DatePicker
            title="Applied after"
            :vmodel=filters.created_after
            param="created_after"
            commit="applicant/setQueryParam"
        />
    </Control>
</template>

<script>
import Control from '../../../../abstract/Table/Control/Control';
import Select from '../../../../abstract/Table/Control/Select';
import ContactedSelect from './ContactedSelect';
import Button from '../../../../abstract/Table/Control/Button';
import DatePicker from '../../../../abstract/Table/Control/DatePicker';
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    setup() {
        const store = useStore();

        return {
            companies: computed(() => store.getters.getCompanies),
            hrs: computed(() => store.getters.getHrs),
            filters: computed(() => store.getters.getApplicantQueryParams),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
            profileIsPersonnel: computed(() => {
                return store.getters.getProfile.role === 'personnel'
            }),
            profileIsHr: computed(() => {
                return store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr'
            }),
            statuses: function () {
                return Object.keys(store.getters.getStatuses).map(function (key) {
                    return {
                        "id": key,
                        "name": key
                    }
                })
            }
        }
    },
    components: {
        Control,
        Select,
        Button,
        DatePicker,
        ContactedSelect
    }
};
</script>
