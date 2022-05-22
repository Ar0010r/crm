<template>
    <Control getter="getMailQueryParams" dispatch="mail/get" commit="mail/setQueryParam">
        <Button title="Create" event="create-mail-form" target="#createMailForm" getter="getMailModel"/>
        <Select title="Company"
                :vmodel=filters.company_id
                :options="companies"
                commit="mail/setQueryParam"
                param="company_id"
        />
        <Select v-if="profileIsAdmin || profileIsTopHr"
            title="Hr"
            :vmodel=filters.hr_id
            :options="hrs"
            commit="mail/setQueryParam"
            param="hr_id"
            name="login"
        />
        <DatePicker
            title="Received after"
            :vmodel=filters.received_after
            param="received_after"
            commit="mail/setQueryParam"
        />
        <DatePicker
            title="Received before"
            :vmodel=filters.received_before
            param="received_before"
            commit="mail/setQueryParam"
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
            companies: computed(() => container.CompanyService.delivery(store.getters.getCompanies)),
            hrs: computed(() => store.getters.getHrs),
            filters: computed(() => store.getters.getMailQueryParams),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
            profileIsTopHr: computed(() => {
                return store.getters.getProfile.role === 'top hr'
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
