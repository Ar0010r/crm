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
                    <CompanyFormFields ref="companyFields" :company="company"/>
                </div>
                <div class="modal-footer">
                    <button id="storeCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button  type="button" class="btn btn-primary" @click="storeCompany(company)">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import CompanyFormFields from './CompanyFormFields';
    import {useStore} from 'vuex';
    import {computed, inject, reactive, ref, onBeforeUnmount} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const companyFields = ref(null);

            const emptyCompany = {...store.getters.getEmptyCompany};
            let company = reactive({...emptyCompany});

            let users = computed(() => store.getters.getUsers);

            async function storeCompany(company) {
                try {
                    await companyFields.value.validate();
                    let response = await container.CompanyService.storeCompany(company);

                    let storedCompany = response.data.company;

                    storedCompany.personnel = users.value[storedCompany.personnel_id];

                    store.commit('company/setCompanyById', storedCompany);
                    document.getElementById('storeCompanyFormClose').click()
                    emitter.emit('notification-success', 'company was created');
                    clearForm()
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }

            }

            const clearForm = () => Object.keys(emptyCompany).forEach(key => company[key] = emptyCompany[key]);

            emitter.on('create-company-form', clearForm);
            onBeforeUnmount(() => emitter.off('create-company-form', clearForm));

            return {storeCompany, company, companyFields}
        },
        components: {
            CompanyFormFields
        }
    };
</script>

