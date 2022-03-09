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
                            <input v-if="file" v-model="file.name" @click="selectFile" class="form-control col-md-10"
                                   name="avatar" placeholder="Click to select an image">
                            <input v-else @click="selectFile" class="form-control col-md-10" name="avatar"
                                   placeholder="Click to select an image">
                        </div>
                    </div>
                    <ManagerFormFields ref="managerFields" :user.sync='user' :show-role-field="false"/>
                </div>
                <div class="modal-footer">
                    <button id="profileFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" @click="updateProfile(user)">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    <input @change="setFile" type="file" id="avatarInput" accept=".jpg, .png, .jpeg"
           style="visibility: hidden; position: absolute; width: 1px; height: 1px;">
</template>

<script>
    import ManagerFormFields from '../manager/ManagerFormFields';
    import {useStore} from 'vuex';
    import {computed, inject, ref, reactive, onBeforeUnmount} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const managerFields = ref(null);
            let user = reactive({});
            let file = ref(null);

            emitter.on('open-profile-form', setProfile);
            onBeforeUnmount(() => emitter.off('open-profile-form', setProfile));

            async function updateProfile(user) {
                if (user.password === null) delete user.password;

                let formData = new FormData();
                if (file.value) formData.set('file', file.value);
                if (user.password) formData.set('password', user.password);

                formData.append('id', user.id);
                formData.append('login', user.login);
                formData.set('_method', 'put');

                try {
                    await managerFields.value.validate();
                    let response = await container.ManagerService.update(formData);

                    store.commit('manager/setProfile', response.data);
                    emitter.emit('notification-success', 'profile was updated');
                    document.getElementById('profileFormClose').click()
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data);
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function setProfile(userData) {
                Object.keys(userData.value).forEach(key => user[key] = userData.value[key])
            }

            return {
                file: computed(() => file.value),
                user, updateProfile, managerFields,
                setFile: event => file.value = event.target.files[0],
                selectFile: () => document.getElementById("avatarInput").click()
            }
        },

        components: {
            ManagerFormFields
        }
    };
</script>

