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
                    <ManagerFormFields :user.sync='user'/>
                </div>
                <div class="modal-footer">
                    <button id="storeUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="storeManager(user)" :disabled="user.password === null || user.login === null || user.role === null || !user.dataIsValid " type="button"
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
    import {computed, inject} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');

            async function storeManager(user) {
                let storedManager = await container.UserService.storeUser(user);
                store.commit('user/setUserById', storedManager.data.user);
                document.getElementById('storeUserFormClose').click()

            }

            return {user: computed(() => store.getters.getUser), storeManager}
        },
        components: {
            ManagerFormFields
        }
    };
</script>

