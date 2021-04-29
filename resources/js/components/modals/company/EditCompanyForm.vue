<template>
    <div class="modal fade" id="editCompanyForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit company
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <CompanyFormFields :company="company"/>
                </div>
                <div class="modal-footer">
                    <button id="editCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled="!company.dataIsValid" @click.prevent="updateCompany(company)" type="button" class="btn btn-primary">Update</button>
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
            const emitter = inject("emitter");
            const container = inject('container');
            let users = computed(() => store.getters.getUsers);
            const emptyCompany = {...store.getters.getEmptyCompany};

            let company = reactive({...emptyCompany});

            emitter.on('edit-company-form', companyData => {
                Object.keys(companyData).forEach(key => company[key] = companyData[key])
            });

            async function updateCompany(company) {
                try{
                    await container.CompanyService.updateCompany(company);

                    company.personnel = users.value[company.personnel_id];
                    store.commit('company/setCompanyById', company);
                    document.getElementById('editCompanyFormClose').click()
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data);
                }
            }

            return {company, updateCompany}
        },
        components : {
            CompanyFormFields
        }
    };
</script>

