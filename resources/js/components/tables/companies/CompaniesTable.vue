<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Companies
        </h4>
        <div v-if="profile.role === 'admin' || profile.role === 'personnel'" class="d-flex justify-content-between mb-3 mt-2">
            <button @click="initializeCompanyStoreForm" class="btn btn-primary btn" data-toggle="modal"
                    data-target="#addCompanyForm">Add company
            </button>
        </div>
        <div v-if="Object.keys(companies).length > 0" class=" table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <CompaniesTableHead/>
                <tbody>
                <CompaniesTableRow v-for="company in companies" :company="company" :key="company.id + company.name"/>
                </tbody>
            </table>
        </div>
        <NoRecords v-else />
    </div>
</template>

<script>
    import CompaniesTableHead from './CompaniesTableHead.vue';
    import CompaniesTableRow from './CompaniesTableRow.vue';
    import CreateCompanyForm from '../../modals/company/CreateCompanyForm';
    import EditCompanyForm from '../../modals/company/EditCompanyForm';
    import NoRecords from '../../layout/NoRecords';
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                profile: computed(() => store.getters.getProfile),
                companies: computed(() => store.getters.getCompanies),
                initializeCompanyStoreForm : () =>  emitter.emit('create-company-form')
            }
        },

        components: {
            CompaniesTableHead,
            CompaniesTableRow,
            CreateCompanyForm,
            EditCompanyForm,
            NoRecords
        }
    };
</script>
