<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Managers</h4>
        <div class="d-flex mb-3">
            <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
                <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
            </button>
            <button @click.prevent="showManagerStoreForm"
                    class="btn btn-primary btn ml-2"
                    data-toggle="modal"
                    data-target="#addManagerForm">
                Add manager
            </button>
        </div>
        <div v-if="Object.keys(users).length > 0" class="table-responsive d-flex align-items-start">
            <Managers/>
        </div>
        <NoRecords v-else/>
    </div>
</template>

<script>
    import NoRecords from '../../layout/NoRecords';
    import Managers from './ManagersTable'

    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                showManagerStoreForm: () => emitter.emit('create-manager-form'),
                users: computed(() => store.getters.getUsers),
                refresh: () => store.dispatch('user/setUsersToStore')
            }
        },

        components: {
            Managers,
            NoRecords
        }
    };
</script>
