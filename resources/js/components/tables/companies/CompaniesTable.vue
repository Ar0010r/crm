<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Companies
        </h4>
        <div v-if="profile.role === 'admin'" class="d-flex justify-content-between mb-3">
            <button @click="initializeCompanyStoreForm" class="btn btn-primary btn" data-toggle="modal"
                    data-target="#addCompanyForm">Add
                company
            </button>
        </div>
        <div class="table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <CompaniesTableHead/>
                <tbody>
                <CompaniesTableRow v-for="company in companies" :company="company"/>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import CompaniesTableHead from './CompaniesTableHead.vue';
    import CompaniesTableRow from './CompaniesTableRow.vue';
    import CreateCompanyForm from '../../modals/company/CreateCompanyForm';
    import EditCompanyForm from '../../modals/company/EditCompanyForm';
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                profile: computed(() => store.getters.getProfile),
                companies: computed(() => store.getters.getCompanies),
                initializeCompanyStoreForm : () =>  emitter.emit('create-company-form'),
            }
        },

        components: {
            CompaniesTableHead,
            CompaniesTableRow,
            CreateCompanyForm,
            EditCompanyForm
        }
    };
</script>
