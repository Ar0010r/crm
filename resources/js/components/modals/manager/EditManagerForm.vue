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
                    <ManagerFormFields :user.sync='manager' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="editUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <!--<button :disabled="!manager.dataIsValid" type="button" class="btn btn-primary"
                            @click="updateManager">Update
                    </button>-->

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
    import {inject, reactive} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const emptyManager = { ...store.getters.getEmptyUser};

            let manager = reactive({...emptyManager});

            emitter.on('edit-manager-form', managerData => {
                Object.keys(managerData).forEach(key => manager[key] = managerData[key])
            });

            async function updateManager() {
                if (manager.password === null) delete manager.password;
                delete manager.dataIsValid;

                try {
                    console.log(manager);
                    await container.UserService.updateUser(manager);
                    store.commit('user/setUserById', manager);
                    document.getElementById('editUserFormClose').click();
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                    //store.dispatch('notification/activate', e.response.data, {root: true});
                }
            }

            return {manager, updateManager}
        },

        components: {
            ManagerFormFields
        }
    };
</script>

