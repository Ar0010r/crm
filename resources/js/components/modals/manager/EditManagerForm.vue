<template>
    <div class="modal fade" id="editManagerForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit manager
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <ManagerFormFields ref="managerFields" :user.sync='manager' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="editUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>

                    <button  type="button" class="btn btn-primary"
                            @click="updateManager">Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ManagerFormFields from './ManagerFormFields';
    import {useStore} from 'vuex';
    import {inject, reactive, ref, onBeforeUnmount} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const managerFields = ref(null);
            const emptyManager = { ...store.getters.getEmptyUser};

            let manager = reactive({...emptyManager});

            emitter.on('edit-manager-form', setUser);
            onBeforeUnmount(() => emitter.off('edit-manager-form', setUser));

            async function updateManager() {
                try {
                    await managerFields.value.validate();
                    if (manager.password === null || manager.password.length === 0) delete manager.password;
                    delete manager.dataIsValid;
                    delete manager.avatar;
                    await container.UserService.updateUser(manager);
                    store.commit('user/setUserById', manager);
                    emitter.emit('notification-success', 'manager was updated');
                    document.getElementById('editUserFormClose').click();
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function setUser(userData) {
                Object.keys(userData).forEach(key => manager[key] = userData[key])
            }

            return {manager, managerFields, updateManager}
        },

        components: {
            ManagerFormFields
        }
    };
</script>

