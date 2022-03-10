<template>
    <div class="form-row mb-2">
        <div v-if="profile.role === 'admin'"
             class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Type </label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="type"
                    v-model=company.type
                    @focus="type.meta.touched = false"
                    @change=companyTypeChanged
                    @blur="type.handleBlur"
                    :class="{'is-invalid': !type.meta.valid && type.meta.touched}">
                <option disabled selected :value="null"> -- select type --</option>
                <option v-for="type in types"
                        :selected='company.type === type.id'
                        :value='type.id'>
                    {{ type.name }}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select a company type</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div v-if="profile.role === 'admin'"
             class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Manager</label>
            <select class="custom-select form-control form-control-sm col-md-10" :disabled="(company.type == null)"
                    name="manager"
                    v-model=company.manager_id
                    @focus="manager.meta.touched = false"
                    @change=manager.handleChange
                    @blur="manager.handleBlur"
                    :class="{'is-invalid': !manager.meta.valid && manager.meta.touched}">
                <option disabled selected :value=null> -- select manager --</option>
                <option v-for="manager in managers"
                        :selected='company.manager_id === manager.id'
                        :value='manager.id'>
                    {{ manager.login }}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select manager</small>
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
            <small class=" col-md-12 invalid-feedback text-right p-0">{{ errors.name || 'name is required' }}</small>
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
            <small class="col-md-12 invalid-feedback text-right p-0">{{ errors.domain || 'domain is required' }}</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Manager</label>
            <input type="text" class="form-control col-md-10" placeholder="Manager name"
                   name="pseudonym"
                   v-model="company.pseudonym"
                   @focus="pseudonym.meta.touched = false"
                   @input="pseudonym.handleChange"
                   @blur="pseudonym.handleBlur"
                   :class="{'is-invalid': !pseudonym.meta.valid && pseudonym.meta.touched}">
            <small
                class=" col-md-12 invalid-feedback text-right p-0">{{
                    errors.pseudonym || 'pseudonym is required'
                }}</small>
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
            <small class=" col-md-12 invalid-feedback text-right p-0">{{ errors.email || 'email is required' }}</small>
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
            type: yup.number().required(),
            manager: yup.string().nullable().required(),
            email: yup.string().nullable().required().email(),
            name: yup.string().nullable().required().trim().matches('^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$', 'company name can contain only letters numbers and spaces'),
            pseudonym: yup.string().nullable().required().trim().matches('^[a-zA-Z ]*$', 'pseudonym can contain only letters'),
            domain: yup.string().nullable().required().trim().matches('^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\\.[a-zA-Z]{2,}$', 'please enter valid domain'),
        });

        const {errors, validate: validateForm} = useForm({
            validationSchema: schema.nullable(),
        });

        const type = useField('type', {value: computed(() => props.company.type)});
        const name = useField('name', {value: computed(() => props.company.name)});
        const pseudonym = useField('pseudonym', {value: computed(() => props.company.pseudonym)});
        const email = useField('email', {value: computed(() => props.company.email)});
        const domain = useField('domain', {value: computed(() => props.company.domain)});
        const manager = useField('manager', {value: computed(() => props.company.manager_id)});

        const config = [
            {
                field: type,
                name: 'type'
            },
            {
                field: manager,
                name: 'manager_id'
            },
            {
                field: name,
                name: 'name'
            },
            {
                field: domain,
                name: 'domain'
            },
            {
                field: email,
                name: 'email'
            },
            {
                field: pseudonym,
                name: 'pseudonym'
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
                    message: 'Please fix form errors:',
                    errors: Object.keys(result.errors).map(key => [result.errors[key]])
                })
            }
        }

        function setValues() {
            config.forEach(item => item.field.value.value = props.company[item.name]);
        }

       /* watch(() => props.company.type, (first, second) => {
            props.company.manager = {"login" : ""}
            props.company.manager_id = null
            console.log('set null');
        });*/

        onBeforeUnmount(() => {
            emitter.off('edit-company-form', setValues);
            emitter.off('create-company-form', resetForm);
        })

        return {
            name, email, domain, manager, type, pseudonym, errors, validate,
            managers: computed(() => props.company.type == 1 ? store.getters.getHrs : store.getters.getPersonnels),
            profile: computed(() => store.getters.getProfile),
            types: [
                {
                    'name': 'Hiring',
                    'id': 1
                },
                {
                    'name': 'Delivery',
                    'id': 0
                }
            ],
            companyTypeChanged: function () {
                type.handleChange
                props.company.manager = {"login" : ""}
                props.company.manager_id = null
            }
        }
    },
    props: {company: Object, showTypeField: Boolean},
    components: {Form, Field},
};
</script>

