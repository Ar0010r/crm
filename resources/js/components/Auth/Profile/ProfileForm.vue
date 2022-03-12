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
                    <div class="form-row mb-2 d-flex flex-column">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Avatar</label>
                            <input v-if="file" v-model="file.name" @click="selectFile" class="form-control col-md-10"
                                   name="avatar" placeholder="Click to select an image">
                            <input v-else @click="selectFile" class="form-control col-md-10" name="avatar"
                                   placeholder="Click to select an image">
                        </div>
                    </div>
                    <div class="form-row mb-2 d-flex flex-column">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Login</label>
                            <input class="form-control col-md-10" type="text" placeholder="Login"
                                   name="login"
                                   v-model="user.login"
                                   @focus="login.meta.touched = false"
                                   @input="login.handleChange"
                                   @blur="login.handleBlur"
                                   :class="{ 'is-invalid': !login.meta.valid && login.meta.touched}"
                            >
                            <small
                                class=" col-md-12 invalid-feedback text-right p-0">{{ errors.login || 'login is required' }}</small>
                        </div>
                    </div>
                    <div class="form-row mb-2 d-flex flex-column">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Password</label>
                            <input class="form-control col-md-10" type="text" placeholder="Password"
                                   name="password"
                                   v-model="user.password"
                                   @focus="password.meta.touched = false"
                                   @input="password.handleChange"
                                   @blur="password.handleBlur"
                                   :class="{
                            'is-invalid': !password.meta.valid && password.meta.touched
                       }"
                            >
                            <small
                                class=" col-md-12 invalid-feedback text-right p-0">{{ errors.password || 'password is required' }}</small>
                        </div>
                    </div>
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
import Body from './Body';
import Form from '../../../abstract/Modal/Form';
import {useStore} from "vuex";
import {computed, inject, onBeforeUnmount, reactive, ref} from "vue";
import * as yup from "yup";
import {useField, useForm} from "vee-validate";

export default {
    setup() {
        const store = useStore();
        const emitter = inject("emitter");
        emitter.on('open-profile-form', setValues);
        let user = reactive({});
        let file = ref(null);

        const schema = yup.object({
            login: yup.string().required().trim().matches('^[a-zA-Z0-9 ]*$', 'login can contain only letters and numbers'),
            password: yup.string().nullable(),
        });

        const {errors, validate: validateForm} = useForm({
            validationSchema: schema.nullable()
        });
        const login = useField('login', {value: computed(() => user.login)});
        const password = useField('password', {value: computed(() => user.password)});

        async function validate() {
            [login, password].forEach(field => {
                field.setTouched(true);
                field.setValue(user[field.name]);
            });

            const result = await validateForm();
            return result.valid
        }

        function setValues() {
            const userData = store.getters.getProfile;
            [login, password].forEach(field => {
                field.value.value = userData[field.name];
            });
        }

        emitter.on('open-profile-form', setProfile);
        onBeforeUnmount(() => emitter.off('open-profile-form', setProfile));

        function setProfile(userData) {
            Object.keys(userData).forEach(key => user[key] = userData[key])
        }

        return {
            schema, errors, validate,
            login, password, user, file,
            setFile: event => file.value = event.target.files[0],
            selectFile: () => document.getElementById("avatarInput").click(),
            updateProfile: async function (user) {
                if(file.value) user.file = file.value
                if (await validate()) {
                    await store.dispatch('profile/update', user);
                    emitter.emit('notification-success', 'profile was updated');
                    document.getElementById('profileFormClose').click()
                }
            }
        }
    },
    components: {
        Body,
        Form
    }
};
</script>
