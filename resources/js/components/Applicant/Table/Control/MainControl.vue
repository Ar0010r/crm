<template>
    <Control getter="getApplicantQueryParams" dispatch="applicant/get" commit="applicant/setQueryParam" show="col-auto">
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

        <Select title="Delivery company"
                :vmodel=filters.company_id
                :options="companies"
                name="name"
                commit="applicant/setQueryParam"
                param="company_id"
        />
        <Select title="Hiring company"
                :vmodel=filters.hr_company_id
                :options="hrCompanies"
                name="name"
                commit="applicant/setQueryParam"
                param="hr_company_id"
        />
        <Select
            v-if="profileIsAdmin"
            title="Hr"
            :vmodel=filters.hr_id
            :options="hrs"
            name="login"
            commit="applicant/setQueryParam"
            param="hr_id"
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
            title="Applied after"
            :vmodel=filters.created_after
            param="created_after"
            commit="applicant/setQueryParam"
        />
        <DatePicker
            title="Applied before"
            :vmodel=filters.created_before
            param="created_before"
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
import {computed, inject} from "vue";

export default {
    setup() {
        const store = useStore();
        const container = inject('container')

        return {
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
                let statuses;

                if(store.getters.getProfile.role === 'personnel') {
                    statuses = store.getters.getAvailableStatuses
                } else {
                    statuses = store.getters.getStatuses
                }
                return Object.keys(statuses).map(function (key) {
                    return {
                        "id": key,
                        "name": key
                    }
                })
            },
            companies: computed(() =>{
                let profile = store.getters.getProfile
                let companies = store.getters.getCompanies
                if(profile.role == 'admin') {
                    return container.CompanyService.delivery(companies)
                }

                if(profile.role == 'hr') {
                    return container.CompanyService.delivery(companies)
                }

                if(profile.role == 'personnel') {
                    return container.CompanyService.controlled(companies, profile)
                }
            }),

            hrCompanies: computed(() =>{
            let profile = store.getters.getProfile
            let companies = store.getters.getCompanies
            if(profile.role == 'admin') {
                return container.CompanyService.hr(companies)
            }

            if(profile.role == 'hr') {
                return container.CompanyService.controlled(companies, profile)
            }

            if(profile.role == 'personnel') {
                return container.CompanyService.hr(companies)
            }
        }),
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
