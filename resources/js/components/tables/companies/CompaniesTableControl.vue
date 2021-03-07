<template>
    <div class="d-flex justify-content-between mb-3">
        <button @click="initializeCompanyStoreForm" class="btn btn-primary btn" data-toggle="modal" data-target="#addCompanyForm">Add
            company
        </button>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    export default {
        setup(){
            const store = useStore();

            function initializeCompanyStoreForm() {
                let emptyCompany = {
                    id: null,
                    name: null,
                    personnel_id: null,
                    personnel: {login: null},
                    domain: null,
                    email: null,
                    created_at: null,
                    dataIsValid: null,
                };

                store.commit('formData/setCompany', emptyCompany);
            }

            return { initializeCompanyStoreForm}
        },

    };
</script>
