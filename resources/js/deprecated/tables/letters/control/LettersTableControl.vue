<template>
    <div class="d-flex mb-3 mt-2">
        <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
            <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
        </button>
        <button @click="initializeLetterStoreForm" class="btn btn-primary btn ml-2" data-toggle="modal"
                data-target="#addLetterForm">
            Add record
        </button>
        <select v-if="profile.role === 'admin' || profile.role === 'top hr'"
                v-model="activeFilters.hr_id" class="custom-select form-control ml-2 col-sm-2 col-1">
            <option value="" selected>Hr</option>
            <option v-for="hr in hrs" :value="hr.id">
                {{hr.login}}
            </option>
        </select>
        <select v-model="activeFilters.company_id" class="custom-select form-control ml-2 col-sm-2">
            <option value="" selected>Company</option>
            <option v-for="company in companies" :value="company.id">
                {{company.name}}
            </option>
        </select>
    </div>
</template>
<script>
    import {useStore} from 'vuex';
    import {computed, watch, inject} from 'vue';

    export default {
        setup() {
            let store = useStore();
            const emitter = inject("emitter");
            let activeFilters = computed(() => store.getters.getMailQueryParams);

            async function filter() {
                store.commit('mail/setQueryParam', {'key':'hr_id', 'value': activeFilters.value.hr_id});

                await getMails();
            }

            async function getMails(){
               /* let filters = {
                    'page': 1,
                    'hr_id': activeFilters.value.hr_id,
                    'company_id': activeFilters.value.company_id,
                    'take': activeFilters.value.take,
                };*/

              /*  let filters = {};

                ["page", "hr_id", "company_id", "take"].map(function(item) {
                    console.log(item)
                });*/

                let filters = {};

                ["page", "hr_id", "company_id", "take"].map(function(item) {
                    if(activeFilters.value[item]) {
                        filters[item] = activeFilters.value[item];
                    }
                });

                await store.dispatch('mail/get', filters);
            }

            watch(() => activeFilters, (first, second) => filter(), {deep: true});

            return {
                profile: computed(() => store.getters.getProfile),
                letters: computed(() => store.getters.getMails),
                companies: computed(() => store.getters.getCompanies),
                initializeLetterStoreForm : () =>  emitter.emit('create-letter-form'),
                hrs: computed(() => store.getters.getHrs),

                activeFilters,
                take: [150, 200, 300, 500],
                refresh: () => {
                    getMails()
                    store.dispatch('manager/setProfile')
                }
            }
        }
    };
</script>
