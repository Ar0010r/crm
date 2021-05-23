<template>
    <div class="form-row mb-2">
        <div v-if="profile.role === 'admin'" class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Personnel</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="personnel"
                    v-model=company.personnel_id
                    @focus="personnel.meta.touched = false"
                    @change=personnel.handleChange
                    @blur="personnel.handleBlur"
                    :class="{'is-invalid': !personnel.meta.valid && personnel.meta.touched}">
                <option disabled selected :value=null> -- select manager --</option>
                <option v-for="personnel in personnels"
                        :selected='company.personnel_id === personnel.id'
                        :value='personnel.id'>
                    {{personnel.login}}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select a personnel manager</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name"
                   name="name"
                   v-model="company.name"
                   @focus="name.meta.touched = false"
                   @input="name.handleChange"
                   @blur="name.handleBlur"
                   :class="{ 'is-invalid': !name.meta.valid && name.meta.touched}">
            <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.name || 'name is required'}}</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Domain</label>
            <input type="text" class="form-control col-md-10" placeholder="Domain"
                   name="domain"
                   v-model="company.domain"
                   @focus="domain.meta.touched = false"
                   @input="domain.handleChange"
                   @blur="domain.handleBlur"
                   :class="{'is-invalid': !domain.meta.valid && domain.meta.touched}">
            <small class="col-md-12 invalid-feedback text-right p-0">{{errors.domain || 'domain is required'}}</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Manager</label>
            <input type="text" class="form-control col-md-10" placeholder="Manager name"
                   name="manager"
                   v-model="company.pseudonym"
                   @focus="manager.meta.touched = false"
                   @input="manager.handleChange"
                   @blur="manager.handleBlur"
                   :class="{'is-invalid': !manager.meta.valid && manager.meta.touched}">
            <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.manager || 'manager name is required'}}</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Email</label>
            <input type="text" class="form-control col-md-10" placeholder="Email"
                   name="email"
                   v-model="company.email"
                   @focus="email.meta.touched = false"
                   @input="email.handleChange"
                   @blur="email.handleBlur"
                   :class="{'is-invalid': !email.meta.valid && email.meta.touched}">
            <small class=" col-md-12 invalid-feedback text-right p-0">{{errors.email || 'email is required'}}</small>
        </div>
    </div>
</template>

<script>
    import {computed, watch, inject, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';
    import {Form, Field, useForm, useField, useResetForm} from 'vee-validate';
    import * as yup from 'yup';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");

            const schema = yup.object({
                personnel: yup.string().nullable().required(),
                email: yup.string().nullable().required().email(),
                name: yup.string().nullable().required().trim().matches('^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$', 'company name can contain only letters numbers and spaces'),
                manager: yup.string().nullable().required().trim().matches('^[a-zA-Z ]*$', 'manager name can contain only letters'),
                domain: yup.string().nullable().required().trim().matches('^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\\.[a-zA-Z]{2,}$', 'please enter valid domain'),
            });

            const {errors, validate: validateForm} = useForm({
                validationSchema: schema.nullable(),
            });

            const name = useField('name', {value: computed(() => props.company.name)});
            const manager = useField('manager', {value: computed(() => props.company.pseudonym)});
            const email = useField('email', {value: computed(() => props.company.email)});
            const domain = useField('domain', {value: computed(() => props.company.domain)});
            const personnel = useField('personnel', {value: computed(() => props.company.personnel_id)});

            const config = [
                {
                    field : personnel,
                    name : 'personnel_id'
                },
                {
                    field : name,
                    name : 'name'
                },
                {
                    field: domain,
                    name : 'domain'
                },
                {
                    field : email,
                    name : 'email'
                },
                {
                    field : manager,
                    name : 'pseudonym'
                }
            ];

            const resetForm = useResetForm();

            emitter.on('edit-company-form', setValues);
            emitter.on('create-company-form', resetForm);

            async function validate() {
                config.forEach(item => {
                    item.field.meta.dirty = true;
                    item.field.meta.touched = true;
                    item.field.value.value = props.company[item.name];
                });

                const result = await validateForm();
                if (!result.valid) {
                    throw ({
                        response: {
                            data: {
                                message: 'Please fix form errors:',
                                errors: Object.keys(result.errors).map(key => [result.errors[key]])
                            }
                        }
                    })
                }
            }

            function setValues() {
                config.forEach(item => item.field.value.value = props.company[item.name]);
            }

            onBeforeUnmount(() => {
                emitter.off('edit-company-form', setValues);
                emitter.off('create-company-form', resetForm);
            })

            return {
                name, email, domain, personnel, manager, errors, validate,
                personnels: computed(() => store.getters.getPersonnels),
                profile: computed(() => store.getters.getProfile),
            }
        },
        props: {company: Object},
        components: {Form, Field},
    };
</script>

