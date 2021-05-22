<template>
    <div class="d-flex justify-content-between align-items-center" style="min-width: 100%">
        <div class="d-flex justify-content-start mb-3" style="width: 80%">
            <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
                <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
            </button>
            <button v-if="profile.role !== 'personnel'" type="button" data-toggle="modal" data-target="#storeEmployeeForm"
                    class=" ml-2 p-0 btn-primary btn col-sm-2 text-nowrap text-center"
                    @click.prevent="showCreateEmployeeForm"
            >Add applicant
            </button>
            <button v-if="profile.role !== 'personnel'" type="button" data-toggle="modal" data-target="#fileInputForm"
                    class=" p-0 btn-primary btn  ml-2 col-sm-2 text-nowrap"
                    @click="showFileUploadForm">File upload
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
        <Statistics/>
    </div>
</template>
<script>
    import {useStore} from 'vuex';
    import {computed, reactive, watch, inject} from 'vue';
    import Statistics from '../Statistics';

    export default {
        setup() {
            let store = useStore();
            const emitter = inject("emitter");
            let activeFilters = computed(() => store.getters.getEmployeeQueryParams);

            async function filter() {
                store.commit('employee/setQueryParam', {'key':'company', 'value': activeFilters.value.company_id});
                store.commit('employee/setQueryParam', {'key':'status', 'value': activeFilters.value.status});
                store.commit('employee/setQueryParam', {'key':'recordsPerPage', 'value': activeFilters.value.recordsPerPage});
                store.commit('employee/setQueryParam', {'key':'hr_id', 'value': activeFilters.value.hr_id});

                await getEmployees();
            }

            async function getEmployees(){
                await store.dispatch('employee/setEmployeesToStore', {
                    'page': 1,
                    'filter[hr_id]': activeFilters.value.hr_id,
                    'filter[status]': activeFilters.value.status,
                    'filter[company_id]': activeFilters.value.company_id,
                    'recordsPerPage': activeFilters.value.recordsPerPage,
                });
            }

            watch(() => activeFilters, (first, second) => filter(), {deep: true});

            return {
                activeFilters,
                hrs: computed(() => store.getters.getHrs),
                recordsPerPage: [150, 200, 300, 500],
                profile: computed(() => store.getters.getProfile),
                statuses: computed(() => store.getters.getStatuses),
                companies: computed(() => store.getters.getCompanies),
                showCreateEmployeeForm: () => emitter.emit('create-employee-form'),
                showFileUploadForm: () => emitter.emit('file-input-form'),
                refresh: () => {
                    getEmployees()
                    store.dispatch('user/setProfileToStore')
                }
            }
        },
        components: {
            Statistics
        }
    };
</script>
