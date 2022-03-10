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
            const profile = computed(() => store.getters.getProfile)
            const managers = computed(() => store.getters.getManagers)

            let companyModel = {...store.getters.getCompanyModel};

            if(profile.value.role === 'personnel' || profile.value.role === 'hr'){
                companyModel.manager_id = profile.id
            }

            if(profile.value.role === 'personnel'){
                companyModel.type = 0
            }

            if(profile.value.role === 'hr'){
                companyModel.type = 1
            }

            let company = reactive({...companyModel});

            async function storeCompany(company) {
                try {
                    await companyFields.value.validate();
                    let response = await container.CompanyService.storeCompany(company);
                    let storedCompany = response.data.model;

                    if(storedCompany.manager_id) {
                        storedCompany.manager = managers.value[storedCompany.manager_id];
                    }

                    store.commit('company/set', storedCompany);
                    document.getElementById('storeCompanyFormClose').click()
                    emitter.emit('notification-success', 'company was created');
                    resetForm()
                } catch (e) {
                    console.log(e);
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }

            }

            function resetForm() {
                Object.keys(companyModel).forEach(key => company[key] = companyModel[key]);

                if(profile.value.role === 'personnel' || profile.value.role === 'hr'){
                    company.manager_id = profile.value.id
                    company.manager = profile.value
                }
            }

            emitter.on('create-company-form', resetForm);
            onBeforeUnmount(() => emitter.off('create-company-form', resetForm));

            return {
                storeCompany,
                company,
                companyFields
            }
        },
        components: {
            CompanyFormFields
        }
    };
</script>

