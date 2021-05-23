<template>
    <div class="modal fade" id="editCompanyForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <CompanyFormFields ref="companyFields" :company="company"/>
                </div>
                <div class="modal-footer">
                    <button id="editCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button @click.prevent="updateCompany" type="button" class="btn btn-primary">Update</button>
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
            const emitter = inject("emitter");
            const container = inject('container');
            const companyFields = ref(null);
            let users = computed(() => store.getters.getUsers);
            let profile = computed(() => store.getters.getProfile);
            const emptyCompany = {...store.getters.getEmptyCompany};

            let company = reactive({...emptyCompany});

            emitter.on('edit-company-form', setCompany);
            onBeforeUnmount(() => emitter.off('edit-company-form', setCompany));

            async function updateCompany() {
                try {
                    await companyFields.value.validate();
                    await container.CompanyService.updateCompany(company);

                    if (profile.value.role !== 'personnel') {
                        company.personnel = users.value[company.personnel_id];
                    }

                    store.commit('company/setCompanyById', company);
                    emitter.emit('notification-success', 'company was updated');
                    document.getElementById('editCompanyFormClose').click()
                } catch (e) {
                    console.log(e)
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function setCompany(companyData) {
                Object.keys(companyData).forEach(key => company[key] = companyData[key])
            }

            return {company, companyFields, updateCompany}
        },
        components: {
            CompanyFormFields
        }
    };
</script>

