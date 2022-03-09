<template>
    <Control getter="getMailQueryParams" dispatch="mail/get" commit="mail/setQueryParam">
        <Button title="Add mail" event="create-mail-form" target="#createMailForm" getter="getMailModel"/>
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
            param="Hr"
            name="login"
        />
        <DatePicker
            title="Received before"
            :vmodel=filters.received_before
            param="received_before"
            commit="mail/setQueryParam"
        />

        <DatePicker
            title="Received after"
            :vmodel=filters.received_after
            param="received_after"
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
import {computed} from "vue";

export default {
    setup() {
        const store = useStore();
        return {
            companies: computed(() => store.getters.getCompanies),
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
