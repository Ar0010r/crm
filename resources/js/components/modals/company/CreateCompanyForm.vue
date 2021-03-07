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
                    <button id="storeCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled="!company.dataIsValid" type="button"
                            class="btn btn-primary"
                            @click="storeCompany(company)">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import CompanyFormFields from './CompanyFormFields';
    import {useStore} from 'vuex';
    import {computed, inject} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');

            let users = computed(() => store.getters.getUsers);

            async function storeCompany(company) {
                let response = await container.CompanyService.storeCompany(company);

                let storedCompany = response.data.company;

                storedCompany.personnel = users.value[storedCompany.personnel_id];

                console.log('users', users.value);
                store.commit('company/setCompanyById', storedCompany);
                document.getElementById('storeCompanyFormClose').click()

            }

            return {company: computed(() => store.getters.getCompany), storeCompany}
        },
        components : {
            CompanyFormFields
        }
    };
</script>

