<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Manager</label>
            <Field as="select"
                   v-slot="{ field ,meta }"
                   v-model=company.personnel_id
                   class="custom-select form-control form-control-sm col-md-10"
                   name="role"
            >
                <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.role && meta.dirty}" v-bind="field" />
                <option disabled selected value> -- select manager --</option>
                <option
                        v-for="personnel in personnels"
                        :value ='personnel.id'
                        :selected='company.personnel_id === personnel.id'>{{personnel.login}}</option>
            </Field>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Name</label>
            <Field name="Name"
                   v-slot="{ field , meta }"
                   v-model="company.name"
                   type="text"
                   class="form-control col-md-10"
                   placeholder="Name"
            >
                <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.name && meta.dirty}" v-bind="field" />
                <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.name}}</small>
            </Field>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Domain</label>
            <Field name="Domain"
                   v-slot="{ field , meta }"
                   v-model="company.domain"
                   type="text"
                   class="form-control col-md-10"
                   placeholder="Domain"
            >
                <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.domain && meta.dirty}" v-bind="field" />
                <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.domain}}</small>
            </Field>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Email</label>
            <Field name="Email"
                   v-slot="{ field , meta }"
                   v-model="company.email"
                   type="text"
                   class="form-control col-md-10"
                   placeholder="Email"
            >
                <input class="form-control col-md-10" :class="{ 'is-invalid': !!errors.email && meta.dirty}" v-bind="field" />
                <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.email}}</small>
            </Field>
        </div>
    </div>
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
                personnel: yup.string().required(),
                name: yup.string().required().trim().matches('^[a-zA-Z]*$', 'login can contain only letters'),
                domain: yup.string().required().trim().matches('^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\\.[a-zA-Z]{2,}$', 'please enter valid domain'),
                email: yup.string().required().email(),
            });

            const {errors} = useForm({
                validationSchema: schema.nullable()
            });

            const {value: personnel} = useField('personnel');
            const {value: name} = useField('name');
            const {value: email} = useField('email');
            const {value: domain} = useField('domain');

            personnel.value = computed(() => props.company.personnel_id);
            name.value = computed(() => props.company.name);
            email.value = computed(() => props.company.email);
            domain.value = computed(() => props.company.domain);

            const resetForm = useResetForm();

            watch(() => props.company, (second, first) => {
                resetForm()
            });


            watch(errors, (second, first) => {

                let allFieldsFilled = props.company.domain !== null &&
                    props.company.name !== null &&
                    props.company.email !== null &&
                    props.company.manager !== null;

                store.commit('formData/setCompanyIsValidState', Object.keys(second).length === 0 && allFieldsFilled)
            });

            return {
                schema, errors, personnels: computed(() => store.getters.getPersonnels)
            }
        },
        props: {company: Object},
        components: {
            Form,
            Field,
            ErrorMessage,
        },
    };
</script>

