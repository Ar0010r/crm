<template>
    <div class="modal fade" id="addCompanyForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add company
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <CompanyFormFields :company="company"/>
                </div>
                <div class="modal-footer">
                    <button id="storeCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button :disabled="!company.dataIsValid" type="button"
                            class="btn btn-primary"
                            @click="storeCompany(company)">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import CompanyFormFields from './CompanyFormFields';
    import {useStore} from 'vuex';
    import {computed, inject, reactive} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");

            const emptyCompany = {...store.getters.getEmptyCompany};
            let company = reactive({...emptyCompany});

            let users = computed(() => store.getters.getUsers);

            emitter.on('create-company-form', () => clearForm());

            async function storeCompany(company) {
                try {
                    let response = await container.CompanyService.storeCompany(company);

                    let storedCompany = response.data.company;

                    storedCompany.personnel = users.value[storedCompany.personnel_id];

                    store.commit('company/setCompanyById', storedCompany);
                    document.getElementById('storeCompanyFormClose').click()
                    clearForm()
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data);
                }

            }

            const clearForm = () => Object.keys(emptyCompany).forEach(key => company[key] = emptyCompany[key]);

            return {storeCompany, company}
        },
        components: {
            CompanyFormFields
        }
    };
</script>

