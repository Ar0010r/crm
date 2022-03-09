<template>
    <div class="d-flex mb-3 mt-2">
        <button class="btn btn-secondary" type="button" title="Refresh">
            <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
        </button>
        <button class="btn btn-primary btn ml-2" data-toggle="modal"
                @click="initializeTestStoreForm"
                data-target="#createTestForm">Add test
        </button>
        <select v-if="profile.role === 'admin' || profile.role === 'top hr'"
                v-model="activeFilters.manager_id" class="custom-select form-control ml-2 col-sm-2 col-1">
            <option value="" selected>Manager</option>
            <option v-for="manager in managers" :value="manager.id">
                {{manager.login}}
            </option>
        </select>
        <select v-model="activeFilters.company_id" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Company</option>
            <option v-for="company in companies" :value="company.id">
                {{company.name}}
            </option>
        </select>
        <select v-model="activeFilters.env" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Env</option>
            <option v-for="env in envs" :value="env">
                {{env}}
            </option>
        </select>
        <select v-model="activeFilters.template" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Template</option>
            <option v-for="template in templates" :value="template">
                {{template}}
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
        let activeFilters = computed(() => store.getters.getTestQueryParams);

        async function filter() {
            store.commit('test/setQueryParam', {'key': 'take', 'value': activeFilters.value.take});
            store.commit('test/setQueryParam', {'key': 'company_id', 'value': activeFilters.value.company_id});
            store.commit('test/setQueryParam', {'key': 'manager_id', 'value': activeFilters.value.manager_id});
            store.commit('test/setQueryParam', {'key': 'env', 'value': activeFilters.value.env});
            store.commit('test/setQueryParam', {'key': 'template', 'value': activeFilters.value.template});

            await getCompanies();
        }

        async function getCompanies() {
            let filters = {};

            ["company_id", "manager_id", "env", "template", "page",  "take"].map(function (key) {
                if (activeFilters.value[key]) {
                    filters[key] = activeFilters.value[key];
                }
            });

            await store.dispatch('test/get', filters);
        }

        watch(() => activeFilters, (first, second) => filter(), {deep: true});

        return {
            activeFilters,
            profile: computed(() => store.getters.getProfile),
            companies: computed(() => store.getters.getCompanies),
            managers: computed(() => store.getters.getManagers),
            envs: computed(() => store.getters.getEnvs),
            templates: computed(() => store.getters.getTemplates),
            initializeTestStoreForm : () =>  emitter.emit('create-test-form'),
            refresh: () => store.dispatch('test/get')
        }
    }
};
</script>
