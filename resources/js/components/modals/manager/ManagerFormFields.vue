<template>
    <Form class="form-row mb-2 d-flex flex-column" :validation-schema="schema">
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
                <label class="form-label col-md-2">Role</label>
                <Field as="select"
                       v-slot="{ field ,meta }"
                       v-model=user.role
                       class="custom-select form-control form-control-sm col-md-10"
                       name="role"
                >
                    <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.role && meta.dirty}" v-bind="field" />
                    <option disabled selected value> -- select role --</option>
                    <option
                            v-for="role in roles"
                            :selected='user.role === role'>{{role}}</option>
                </Field>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Login</label>
                <Field name="login"
                       v-slot="{ field , meta }"
                       v-model="user.login"
                       type="text"
                       class="form-control col-md-10"
                       placeholder="Login"
                >
                    <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.login && meta.dirty}" v-bind="field" />
                    <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.login}}</small>
                </Field>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Password</label>
                <Field name="password"
                       v-slot="{ field ,meta }"
                       v-model="user.password"
                       type="text"
                       placeholder="Password"
                >
                    <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.password }" v-bind="field" />
                    <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.password}}</small>
                </Field>
            </div>
        </div>
        <button @click.prevent="generatePass" type="button" class="btn btn-light  align-self-end">Generate pass
        </button>
    </Form>
</template>

<script>
    import {computed, watch} from 'vue';
    import {useStore} from 'vuex';
    import { Form, Field, ErrorMessage, useForm, useField, useResetForm } from 'vee-validate';
    import * as yup from 'yup';

    export default {
        setup(props) {
            const store = useStore();

            const schema = yup.object({
                login: yup.string().required().trim().matches('^[a-zA-Z0-9]*$', 'login can contain only letters and numbers'),
                role: yup.string().required(),
                password: yup.string().nullable().min(8),
            });

            const {errors} = useForm({
                validationSchema: schema.nullable()
            });

            const {value: login} = useField('login');
            const {value: role} = useField('role');
            const {value: password} = useField('password');

            login.value = computed(() => props.user.login);
            role.value = computed(() => props.user.role);
            password.value = computed(() => props.user.password);

            const resetForm = useResetForm();

            watch(() => props.user, (first, second) => {setTimeout(()=> resetForm(), 100)});


            watch(errors, (second, first) => {
                store.commit('formData/setUserIsValidState', Object.keys(second).length === 0)
            });

            function generatePass() {
                let length = 8,
                    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                    password = "";

                for (let i = 0, n = charset.length; i < length; ++i) {
                    password += charset.charAt(Math.floor(Math.random() * n));
                }
                props.user.password = password;
            }

            return {
                schema,generatePass, roles: computed(() => store.getters.getRoles), errors,
            }
        },
        props: {user: Object},
        components: {
            Form,
            Field,
            ErrorMessage,
        },
    };
</script>

