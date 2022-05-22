<template>
    <Control getter="getSubscriptionQueryParams" dispatch="subscription/get" commit="subscription/setQueryParam">
        <Button title="Create" event="create-subscription-form" target="#createSubscriptionForm" getter="getSubscriptionModel"/>
        <Select title="Company"
                :vmodel=filters.company_id
                :options="companies"
                name="name"
                commit="subscription/setQueryParam"
                param="company_id"
        >
        </Select>
        <Select
            title="Provider"
            :vmodel=filters.provider
            :options="providers()"
            commit="subscription/setQueryParam"
            param="provider"
        ></Select>
        <Select
            title="Service"
            :vmodel=filters.service
            :options="services()"
            commit="subscription/setQueryParam"
            param="service"
        ></Select>
        <Select
            title="Status"
            :vmodel=filters.status
            :options="statuses()"
            commit="subscription/setQueryParam"
            param="status"
        ></Select>
        <DatePicker
            title="Paid after"
            :vmodel=filters.paid_after
            param="paid_after"
            commit="subscription/setQueryParam"
        />
        <DatePicker
            title="Paid before"
            :vmodel=filters.paid_before
            param="paid_before"
            commit="subscription/setQueryParam"
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
            filters: computed(() => store.getters.getSubscriptionQueryParams),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
            providers: function () {
                return store.getters.getProviders.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            },
            services: function () {
                return store.getters.getServices.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            },
            statuses: function () {
                return store.getters.getSubscriptionStatuses.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            },
            companies: computed(() => container.CompanyService.controlled(
                store.getters.getCompanies, store.getters.getProfile
            )),
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
