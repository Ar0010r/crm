<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Managers</h4>
        <div class="d-flex justify-content-between mb-3">
            <button @click.prevent="showManagerStoreForm"
                    class="btn btn-primary btn"
                    data-toggle="modal"
                    data-target="#addManagerForm">
                Add manager
            </button>
        </div>
        <div v-if="Object.keys(users).length > 0" class="table-responsive d-flex align-items-start">
            <Managers/>
            <div class="d-flex flex-column align-items-center col-6">
                <PersonnelStatistics/>
                <HrStatistics/>
            </div>

        </div>
        <NoRecords v-else/>
    </div>
</template>

<script>
    import NoRecords from '../../layout/NoRecords';
    import Managers from './ManagersTable'
    import HrStatistics from './HrStatisticsTable'
    import PersonnelStatistics from './PersonnelStatisticsTable'

    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                showManagerStoreForm: () => emitter.emit('create-manager-form'),
                users: computed(() => store.getters.getUsers),
            }
        },

        components: {
            Managers,
            HrStatistics,
            PersonnelStatistics,
            NoRecords
        }
    };
</script>
