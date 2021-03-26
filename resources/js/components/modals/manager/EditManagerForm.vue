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
                    <ManagerFormFields :user.sync='user' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="editUserFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled="!user.dataIsValid" type="button" class="btn btn-primary" @click="updateUser(user)">Update</button>
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

            async function updateUser(user) {
                if(user.password ===  null) delete user.password;
                delete user.dataIsValid;
                await container.UserService.updateUser(user);
                store.commit('user/setUserById', user);
                document.getElementById('editUserFormClose').click();
            }

            return {user: computed(() => store.getters.getUser), updateUser}
        },

        components: {
            ManagerFormFields
        }
    };
</script>

