<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Managers
        </h4>
        <div class="d-flex justify-content-between mb-3">
            <button @click.prevent="showManagerStoreForm"
                    class="btn btn-primary btn"
                    data-toggle="modal"
                    data-target="#addManagerForm">
                Add manager
            </button>
        </div>
        <div class="table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <ManagersTableHead/>
                <tbody>
                <ManagersTableRow
                        v-for="user in users"
                        :key="user.id"
                        :user.sync='user'
                />
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import StoreManagerForm from '../../modals/manager/CreateManagerForm';
    import EditManagerForm from '../../modals/manager/EditManagerForm';
    import ManagersTableHead from './ManagersTableHead';
    import ManagersTableRow from './ManagersTableRow';

    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                showManagerStoreForm : () =>  emitter.emit('create-manager-form'),
                users: computed(() => store.getters.getUsers),
            }
        },

        components: {
            StoreManagerForm,
            EditManagerForm,
            ManagersTableHead,
            ManagersTableRow
        }
    };
</script>
