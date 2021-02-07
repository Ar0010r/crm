<template>
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <select class="custom-select form-control form-control-sm ml-2">
                <option value="10">Company</option>
                <option v-for="company in companies" :value="company.id">{{company.name}}</option>
            </select>
            <select class="custom-select custom-select form-control-lg form-control-sm ml-2">
                <option value="10">Status</option>
                <option v-for="(key, value) in statuses" :value="value">{{value}}</option>
            </select>
            <select class="custom-select custom-select form-control-lg form-control-sm ml-2">
                <option value="10">Hr</option>
                <option value="10">Hr1</option>
                <option value="10">Hr2</option>
                <option value="25">Hr3</option>
                <option value="50">Hr4</option>
            </select>
        </div>
        <div id="DataTables_Table_0_filter"
             class="col-md-4 dataTables_filter d-flex align-items-center justify-content-end ">
            <button type="button" data-toggle="modal" data-target="#storeEmployeeForm"
                    class="btn-primary btn w-auto col-sm-5"
                    @click.prevent="initializeEmployeeStoreForm"
            >Add employee
            </button>
            <button type="button" data-toggle="modal" data-target="#fileInputForm"
                    class="btn-primary btn w-auto ml-2 col-sm-4">File upload
            </button>
            <select class="custom-select ml-2 col-md-4">
                <option value="10">Records</option>
                <option value="25">10</option>
                <option value="50">20</option>
                <option value="100">30</option>
            </select>
        </div>
    </div>
</template>

<script>
    import {useStore} from 'vuex'
    import {computed} from 'vue'
    export default {
        setup(){

            return{
                activeFilters:{},
                companies: computed(() => useStore().getters.getCompanies),
                statuses: computed(() => useStore().getters.getStatuses),
                hrs: computed(() => useStore().getters.getHrs),
            }

        },
        methods:{
            initializeEmployeeStoreForm(){
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
                    birthday: "",
                    race: "",
                    status: "",
                    pickup: "",
                };

                this.$store.commit('setEmployee', emptyEmployee);
            }
        }
    };
</script>
