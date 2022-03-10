<template>
    <div class="form-row mb-2 d-flex flex-column">
        <div v-if="showRoleField" id="managerRoleField" class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Role</label>
                <select class="custom-select form-control form-control-sm col-md-10"
                        name="role"
                        v-model=user.role
                        @focus="role.meta.touched = false"
                        @change=role.handleChange
                        @blur="role.handleBlur"
                        :class="{'is-invalid': !role.meta.valid && role.meta.touched}"
                >
                    <option disabled selected value> -- select role --</option>
                    <option
                            v-for="role in roles"
                            :value="role"
                            :selected='user.role === role'>{{role}}
                    </option>
                </select>
                <small class="col-md-12 invalid-feedback text-right p-0">please select a role</small>
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
                <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.login || 'login is required'}}</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Password</label>
                <input ref='passwordField' class="form-control col-md-10" type="text" placeholder="Password"
                       name="password"
                       v-model="user.password"
                       @focus="password.meta.touched = false"
                       @input="password.handleChange"
                       @blur="password.handleBlur"
                       :class="{
                            'is-invalid': !password.meta.valid && password.meta.touched ||
                                          passwordRequired && !user.password && password.meta.touched
                       }"
                >
                <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.password || 'password is required'}}</small>
            </div>
        </div>
        <button @click.prevent="generatePass" type="button" class="btn btn-light  align-self-end">Generate pass
        </button>
    </div>
</template>

<script>
    import {computed, inject, ref, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';
    import {useForm, useField, useResetForm} from 'vee-validate';
    import * as yup from 'yup';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const passwordField = ref(null)
            let passwordRequired = ref(null);
            emitter.on('create-manager-form', () => passwordRequired.value = true);
            emitter.on('edit-manager-form', () => passwordRequired.value = false);
            emitter.on('open-profile-form', () => passwordRequired.value = false);

            const schema = yup.object({
                login: yup.string().required().trim().matches('^[a-zA-Z0-9 ]*$', 'login can contain only letters and numbers'),
                role: yup.string().required(),
                password: yup.string().nullable(),
            });

            const {errors, validate: validateForm} = useForm({
                validationSchema: schema.nullable()
            });

            const role = useField('role', {value: computed(() => props.user.role)});
            const login = useField('login', {value: computed(() => props.user.login)});
            const password = useField('password', {value: computed(() => props.user.password)});

            const resetForm = useResetForm();

            emitter.on('create-manager-form', resetForm);
            emitter.on('edit-manager-form', setValues);
            emitter.on('open-profile-form', setValues);


            function generatePass() {
                let length = 8,
                    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                    generatedPassword = "";

                for (let i = 0, n = charset.length; i < length; ++i) {
                    generatedPassword += charset.charAt(Math.floor(Math.random() * n));
                }

                props.user.password = generatedPassword;
                //password.value = generatedPassword;
                password.meta.touched = true;
                password.meta.valid = true;
            }

            async function validate() {
                [login, role, password].forEach(field => {
                    field.setTouched(true);
                    field.setValue(props.user[field.name]);
                   /* field.meta.dirty = true;
                    field.meta.touched = true;
                    field.value.value = props.user[field.name];*/
                });

                const result = await validateForm();

                if (!result.valid) {
                    if(passwordRequired.value && !password.value.value) result.errors.password = 'password is required';

                    throw ({
                        message: 'Please fix form errors:',
                        errors: Object.keys(result.errors).map(key => [result.errors[key]])
                    })
                }
            }

            function setValues() {
                [login, role, password].forEach(field => {
                    field.value.value = props.user[field.name];
                });
            }

            onBeforeUnmount(() => {
                emitter.off('create-manager-form', resetForm);
                emitter.off('edit-manager-form', setValues);
            })

            return {
                schema, errors, validate, passwordRequired,
                login, role, password, generatePass, passwordField,
                roles: computed(() => store.getters.getRoles),
                profile: computed(() => store.getters.getProfile),

            }
        },
        props: {user: Object, showRoleField: Boolean},
    };
</script>

