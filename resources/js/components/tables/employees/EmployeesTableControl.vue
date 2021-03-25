<template>
    <div class="d-flex justify-content-start mb-3" style="max-width: 55%">
        <button type="button" data-toggle="modal" data-target="#storeEmployeeForm"
                class=" p-0 btn-primary btn col-sm-2 text-nowrap text-center"
                @click.prevent="initializeEmployeeStoreForm"
        >Add employee
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
            <option value="" selected >Records</option>
            <option v-for="record in recordsPerPage" :value="record">
                {{record}}
            </option>
        </select>
    </div>
</template>

<script>
    import {useStore} from 'vuex'
    import {computed, reactive, inject, watch} from 'vue'

    export default {
        setup() {
            const container = inject('container');

            let store = useStore();

            let activeFilters = reactive({company_id: '', status: '', hr_id: '', recordsPerPage:''});


            const filter = async () => {
                store.commit('employee/setQueryParam', {'key':'company_id', 'value': activeFilters.company_id});
                store.commit('employee/setQueryParam', {'key':'hr_id', 'value': activeFilters.hr_id});
                store.commit('employee/setQueryParam', {'key':'status', 'value': activeFilters.status});
                store.commit('employee/setQueryParam', {'key':'recordsPerPage', 'value': activeFilters.recordsPerPage});

                let params = store.getters.getEmployeeQueryParams;

                console.log(params.hr_id);

                let employees = await container.EmployeeService.getEmployees({
                    'filter[company_id]': params.company_id,
                    'filter[status]': params.status,
                    'filter[hr_id]': params.hr_id,
                    'page': params.page,
                    'recordsPerPage': params.recordsPerPage,
                });

                store.commit('employee/setEmployees', employees.employees);
                store.commit('employee/setPagination', employees.pagination);
            };

            watch(() => activeFilters, (first, second) => {
                filter();
            }, {deep: true});

            return {
                activeFilters: activeFilters,
                companies: computed(() => store.getters.getCompanies),
                statuses: computed(() => store.getters.getStatuses),
                hrs: computed(() => store.getters.getHrs),
                recordsPerPage: [10,30,50,100,300,500],
                profile: computed(() => store.getters.getProfile)
            }

        },
        methods: {
            initializeEmployeeStoreForm() {
                let emptyEmployee = {
                    id: "",
                    name: "",
                    email: "",
                    paypal: "",
                    company: "",
                    address: "",
                    city: "",
                    state: "",
                    zip: "",
                    phone_1: "",
                    phone_2: "",
                    birthday: null,
                    race: "",
                    status: "",
                    pickup: "",
                };

                this.$store.commit('formData/setEmployee', emptyEmployee);
            }
        }
    };
</script>
