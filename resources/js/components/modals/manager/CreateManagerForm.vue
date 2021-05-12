<template>
    <div class="modal fade" id="addManagerForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add manager
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <ManagerFormFields ref="managerFields" :user.sync='manager' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="storeUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button @click.prevent="storeManager" type="button"
                            class="btn btn-primary">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ManagerFormFields from './ManagerFormFields';
    import {useStore} from 'vuex';
    import {ref, inject, reactive, onBeforeUnmount} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const managerFields = ref(null);
            const emptyManager = {...store.getters.getEmptyUser};

            let manager = reactive({...emptyManager});

            async function storeManager() {
                try {
                    await managerFields.value.validate();
                    let storedManager = await container.UserService.storeUser(manager);
                    store.commit('user/setUserById', storedManager.data.user);
                    document.getElementById('storeUserFormClose').click()
                    emitter.emit('notification-success', 'manager was added');
                    clearForm();
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            const clearForm = () => Object.keys(emptyManager).forEach(key => manager[key] = emptyManager[key]);
            emitter.on('create-manager-form', clearForm);
            onBeforeUnmount(() => emitter.off('create-manager-form', clearForm));

            return {manager, managerFields, storeManager}
        },
        components: {
            ManagerFormFields
        }
    };
</script>

