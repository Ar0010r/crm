<template>
    <div class="modal fade" id="profileForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit profile
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row mb-2 d-flex flex-column p-0">
                        <div class=" p-0 form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Avatar</label>
                            <input class="form-control col-md-10" name="avatar" placeholder="Click to select an image">
                        </div>
                    </div>
                    <ManagerFormFields :user.sync='user' :show-role-field="false"/>
                </div>
                <div class="modal-footer">
                    <button id="profileFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button :disabled="!user.dataIsValid" type="button" class="btn btn-primary"
                            @click="updateUser(user)">Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ManagerFormFields from '../manager/ManagerFormFields';
    import {useStore} from 'vuex';
    import {computed, inject} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');

            async function updateUser(user) {
                if (user.password === null) delete user.password;

                await container.UserService.updateUser(user);

                store.commit('user/setProfile', user);
                document.getElementById('profileFormClose').click();
            }

            return {user: computed(() => store.getters.getUser), updateUser}
        },

        components: {
            ManagerFormFields
        }
    };
</script>

