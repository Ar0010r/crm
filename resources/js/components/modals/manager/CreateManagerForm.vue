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
                    <ManagerFormFields :user.sync='manager' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="storeUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="storeManager" :disabled="manager.password === null || manager.login === '' || manager.role === '' || !manager.dataIsValid " type="button"
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
    import {computed, inject, reactive} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const emptyManager = { ...store.getters.getEmptyUser};

            let manager = reactive({...emptyManager});

            emitter.on('create-manager-form', () => clearForm());

            async function storeManager() {
                try{
                    let storedManager = await container.UserService.storeUser(manager);
                    store.commit('user/setUserById', storedManager.data.user);
                    document.getElementById('storeUserFormClose').click()
                    clearForm();
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data, {root: true});
                }
            }

            const clearForm = () => Object.keys(emptyManager).forEach(key => manager[key] = emptyManager[key]);

            return {manager, storeManager}
        },
        components: {
            ManagerFormFields
        }
    };
</script>

