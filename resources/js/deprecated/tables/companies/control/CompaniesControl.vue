<template>
    <div class="d-flex mb-3 mt-2">
        <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
            <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
        </button>
        <button @click="initializeCompanyStoreForm" class="btn btn-primary btn ml-2" data-toggle="modal"
                data-target="#addCompanyForm">Add company
        </button>
        <select v-if="profile.role === 'admin' || profile.role === 'top hr' || profile.role === 'hr'"
                v-model="activeFilters.type"
                class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Type</option>
            <option value = "0">Delivery</option>
            <option value = "1">Hiring</option>
        </select>
        <select v-if="profile.role === 'admin' || profile.role === 'top hr'"
                v-model="activeFilters.manager_id" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Hr</option>
            <option v-for="manager in managers" :value="manager.id">
                {{ manager.login }}
            </option>
        </select>
    </div>
</template>

<script>
import {computed, inject, watch} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();
        const emitter = inject("emitter");
        let activeFilters = computed(() => store.getters.getCompanyQueryParams);

        async function filter() {
            store.commit('company/setQueryParam', {'key': 'take', 'value': activeFilters.value.take});
            store.commit('company/setQueryParam', {'key': 'manager_id', 'value': activeFilters.value.manager_id});
            store.commit('company/setQueryParam', {'key': 'type', 'value': activeFilters.value.type});

            await getCompanies();
        }

        async function getCompanies() {
            let filters = {};

            ["page", "manager_id", "take", "type"].map(function (key) {
                if (activeFilters.value[key]) {
                    filters[key] = activeFilters.value[key];
                }
            });

            await store.dispatch('company/get', filters);
        }

        watch(() => activeFilters, (first, second) => filter(), {deep: true});

        return {
            activeFilters,
            profile: computed(() => store.getters.getProfile),
            companies: computed(() => store.getters.getCompanies),
            managers: computed(() => store.getters.getManagers),
            initializeCompanyStoreForm : () =>  emitter.emit('create-company-form'),
            refresh: () => store.dispatch('company/get')
        }
    }
};
</script>
