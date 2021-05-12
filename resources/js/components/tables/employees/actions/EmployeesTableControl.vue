<template>
    <div class="d-flex justify-content-start mb-3" style="max-width: 60%">
        <button type="button" data-toggle="modal" data-target="#storeEmployeeForm"
                class=" p-0 btn-primary btn col-sm-2 text-nowrap text-center"
                @click.prevent="showCreateEmployeeForm"
        >Add applicant
        </button>
        <button type="button" data-toggle="modal" data-target="#fileInputForm"
                class=" p-0 btn-primary btn  ml-2 col-sm-2 text-nowrap">File upload
        </button>
        <select v-model="activeFilters.company_id" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Company</option>
            <option v-for="company in companies" :value="company.id">
                {{company.name}}
            </option>
        </select>
        <select v-if="profile.role === 'admin' || profile.role === 'top hr'"
                v-model="activeFilters.hr_id" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Hr</option>
            <option v-for="hr in hrs" :value="hr.id">
                {{hr.login}}
            </option>
        </select>
        <select v-model="activeFilters.status"
                class="custom-select custom-select form-control-lg  ml-2 col-sm-2">
            <option value="" selected>Status</option>
            <option v-for="(key, value) in statuses" :value="value">{{value}}</option>
        </select>
        <select v-model="activeFilters.recordsPerPage" class="custom-select ml-2 col-sm-2">
            <option value="" selected>100</option>
            <option v-for="record in recordsPerPage" :value="record">
                {{record}}
            </option>
        </select>
    </div>
    <SelectedControl/>
</template>
<script>
    import {useStore} from 'vuex';
    import {computed, reactive, watch, inject} from 'vue';
    import SelectedControl from './SelectedEmployeesControl'

    export default {
        setup() {
            let store = useStore();
            const emitter = inject("emitter");
            let activeFilters = reactive({company_id: '', status: '', hr_id: '', recordsPerPage: ''});

            async function filter() {
                await store.dispatch('employee/setEmployeesToStore', {
                    'page': 1,
                    'filter[hr_id]': activeFilters.hr_id,
                    'filter[status]': activeFilters.status,
                    'filter[company_id]': activeFilters.company_id,
                    'recordsPerPage': activeFilters.recordsPerPage,
                });
            }

            watch(() => activeFilters, (first, second) => filter(), {deep: true});

            return {
                activeFilters: activeFilters,
                hrs: computed(() => store.getters.getHrs),
                recordsPerPage: [150, 200, 300, 500],
                profile: computed(() => store.getters.getProfile),
                statuses: computed(() => store.getters.getStatuses),
                companies: computed(() => store.getters.getCompanies),
                showCreateEmployeeForm: () => emitter.emit('create-employee-form')
            }
        },
        components: {
            SelectedControl
        }
    };
</script>
