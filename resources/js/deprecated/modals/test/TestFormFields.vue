<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Company </label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="company"
                    v-model=test.company_id
                    @focus="company.meta.touched = false"
                    @change=company.handleChange
                    @blur="company.handleBlur"
                    :class="{'is-invalid': !company.meta.valid  && company.meta.touched}"
            >
                <option disabled selected :value=null> -- select company --</option>
                <option v-for="company in companies"
                        :value='company.id'
                        :selected='company.id === test.company_id'>
                    {{company.name}}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select a company</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Env</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="role"
                    v-model=test.env
                    @focus="env.meta.touched = false"
                    @change=env.handleChange
                    @blur="env.handleBlur"
                    :class="{'is-invalid': !env.meta.valid && env.meta.touched}"
            >
                <option disabled selected :value=null> -- select env --</option>
                <option
                    v-for="env in envs"
                    :selected='test.env === env'>{{env}}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select an environment</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Template </label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="role"
                    v-model=test.template
                    @focus="template.meta.touched = false"
                    @change=template.handleChange
                    @blur="template.handleBlur"
                    :class="{'is-invalid': !template.meta.valid && template.meta.touched}"
            >
                <option disabled selected :value=null> -- select template --</option>
                <option
                    v-for="template in templates"
                    :selected='test.template === template'>{{template}}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select a template</small>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Google </label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="google"
                    v-model=test.google
                    @focus="google.meta.touched = false"
                    @change=google.handleChange
                    @blur="google.handleBlur"
                    :class="{'is-invalid': !google.meta.valid && google.meta.touched}"
            >
                <option disabled selected :value="null"> -- select result --</option>
                <option value=1> Inbox</option>
                <option value=0> Spam</option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Outlook</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="google"
                    v-model=test.outlook
                    @focus="outlook.meta.touched = false"
                    @change=outlook.handleChange
                    @blur="outlook.handleBlur"
                    :class="{'is-invalid': !outlook.meta.valid && outlook.meta.touched}"
            >
                <option disabled selected :value="null"> -- select result --</option>
                <option value=1> Inbox</option>
                <option value=0> Spam</option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Yahoo</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="google"
                    v-model=test.yahoo
                    @focus="yahoo.meta.touched = false"
                    @change=yahoo.handleChange
                    @blur="yahoo.handleBlur"
                    :class="{'is-invalid': !yahoo.meta.valid && yahoo.meta.touched}"
            >
                <option disabled selected :value="null"> -- select result --</option>
                <option value=1> Inbox</option>
                <option value=0> Spam</option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2">Date</label>
            <input class="form-control col-md-10" type="text" placeholder="Date"
                   name="received_at"
                   v-model="test.date"
                   @focus="date.meta.touched = false"
                   @input="date.handleChange"
                   @blur="date.handleBlur"
                   :class="{ 'is-invalid': !date.meta.valid && date.meta.touched}"
            >
            <small class=" col-md-12 invalid-feedback text-right p-0">{{ errors.date || 'received_at is required' }}</small>
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
            company: yup.string().nullable().required(),
            env: yup.string().nullable().required(),
            template: yup.string().nullable().required(),
            google: yup.boolean().nullable(),
            outlook: yup.boolean().nullable(),
            yahoo: yup.boolean().nullable(),
            date: yup.string().nullable().matches("^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$", 'valid date format is yyyy-mm-dd'),
        });

        const {errors, validate: validateForm} = useForm({
            validationSchema: schema.nullable(),
        });

        const company = useField('company', {value: computed(() => props.test.company_id)});
        const env = useField('env', {value: computed(() => props.test.env)});
        const template = useField('template', {value: computed(() => props.test.template)});
        const google = useField('google', {value: computed(() => props.test.google)});
        const outlook = useField('outlook', {value: computed(() => props.test.outlook)});
        const yahoo = useField('yahoo', {value: computed(() => props.test.yahoo)});
        const date = useField('date', {value: computed(() => props.test.date)});

        const config = [
            {
                field: company,
                name: 'company_id'
            },
            {
                field: env,
                name: 'env'
            },
            {
                field: template,
                name: 'template'
            },
            {
                field: google,
                name: 'google'
            },
            {
                field: outlook,
                name: 'outlook'
            },
            {
                field: yahoo,
                name: 'yahoo'
            },
            {
                field: date,
                name: 'date'
            },
        ];

        const resetFormMeta = useResetForm();

        function resetForm() {
            resetFormMeta();

            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1;
            let yyyy = today.getFullYear();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            props.test.date = yyyy + '-' + mm + '-' + dd;
            /*config.forEach(item => {
                props.test[item.name] = item.field.value.value;
            });*/
            console.log(date.value.value)
        }

        emitter.on('edit-test-form', setValues);
        emitter.on('create-test-form', resetForm);

        async function validate() {
            config.forEach(item => {
                item.field.meta.dirty = true;
                item.field.meta.touched = true;
                item.field.value.value = props.test[item.name];
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
            config.forEach(item => item.field.value.value = props.test[item.name]);
        }

        onBeforeUnmount(() => {
            emitter.off('edit-test-form', setValues);
            emitter.off('create-test-form', resetFormMeta);
        })

        return {
            company, env, template, google, outlook, yahoo, date, errors, validate,
            companies: computed(() => store.getters.getCompanies),
            envs: computed(() => store.getters.getEnvs),
            templates: computed(() => store.getters.getTemplates),
        }
    },
    props: {test: Object},
};
</script>

