<template>
    <div class="form-row mb-2 d-flex flex-column">
        <div v-if="profile.role === 'admin'" id="letterHrField" class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Hr</label>
                <select class="custom-select form-control form-control-sm col-md-10"
                        name="hr"
                        v-model=letter.hr_id
                        @focus="hr.meta.touched = false"
                        @change=hr.handleChange
                        @blur="hr.handleBlur"
                        :class="{'is-invalid': !!errors.hr && hr.meta.touched}"
                >
                    <option disabled selected :value=null> -- select hr --</option>
                    <option
                        v-for="hr in hrs"
                        :selected='letter.hr_id === hr.id'
                        :value='hr.id'>
                        {{ hr.login }}
                    </option>
                </select>
                <small class="col-md-12 invalid-feedback text-right p-0">please select hr</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Company</label>
                <select class="custom-select form-control form-control-sm col-md-10"
                        name="company"
                        v-model=letter.company_id
                        @focus="company.meta.touched = false"
                        @change=company.handleChange
                        @blur="company.handleBlur"
                        :class="{'is-invalid': !!errors.company  && company.meta.touched}"
                >
                    <option disabled selected :value=null> -- select company --</option>
                    <option v-for="company in companies"
                            :value='company.id'
                            :selected='company.id === letter.company_id'>
                        {{ company.name }}
                    </option>
                </select>
                <small class="col-md-12 invalid-feedback text-right p-0">please select company</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Google</label>
                <input class="form-control col-md-10" type="text" placeholder="Google"
                       name="google"
                       v-model="letter.google"
                       @focus="google.meta.touched = false"
                       @input="google.handleChange"
                       @blur="google.handleBlur"
                       :class="{ 'is-invalid': !google.meta.valid && google.meta.touched}"
                >
                <small
                    class=" col-md-12 invalid-feedback text-right p-0">{{ errors.google || 'google is required' }}</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Yahoo</label>
                <input class="form-control col-md-10" type="text" placeholder="Yahoo"
                       name="yahoo"
                       v-model="letter.yahoo"
                       @focus="yahoo.meta.touched = false"
                       @input="yahoo.handleChange"
                       @blur="yahoo.handleBlur"
                       :class="{ 'is-invalid': !yahoo.meta.valid && yahoo.meta.touched}"
                >
                <small
                    class=" col-md-12 invalid-feedback text-right p-0">{{ errors.yahoo || 'yahoo is required' }}</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Outlook</label>
                <input class="form-control col-md-10" type="text" placeholder="Outlook"
                       name="outlook"
                       v-model="letter.outlook"
                       @focus="outlook.meta.touched = false"
                       @input="outlook.handleChange"
                       @blur="outlook.handleBlur"
                       :class="{ 'is-invalid': !outlook.meta.valid && outlook.meta.touched}"
                >
                <small
                    class=" col-md-12 invalid-feedback text-right p-0">{{ errors.outlook || 'outlook is required' }}</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Other</label>
                <input class="form-control col-md-10" type="text" placeholder="Other"
                       name="other"
                       v-model="letter.other"
                       @focus="other.meta.touched = false"
                       @input="other.handleChange"
                       @blur="other.handleBlur"
                       :class="{ 'is-invalid': !other.meta.valid && other.meta.touched}"
                >
                <small
                    class=" col-md-12 invalid-feedback text-right p-0">{{ errors.other || 'other is required' }}</small>
            </div>
        </div>
        <div class="form-row mb-2 d-flex flex-column">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                <label class="form-label col-md-2">Received</label>
                <input class="form-control col-md-10" type="text" placeholder="Received"
                       name="received_at"
                       v-model="letter.received_at"
                       @focus="received.meta.touched = false"
                       @input="received.handleChange"
                       @blur="received.handleBlur"
                       :class="{ 'is-invalid': !received.meta.valid && received.meta.touched}"
                >
                <small
                    class=" col-md-12 invalid-feedback text-right p-0">{{ errors.received_at || 'received_at is required' }}</small>
            </div>
        </div>
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

        const schema = yup.object({
            hr: yup.string().nullable().required(),
            company: yup.string().nullable().required(),
            google: yup.string().required().trim().matches('^[0-9]*$', 'please enter numeric amount of letters you received'),
            yahoo: yup.string().required().trim().matches('^[0-9]*$', 'please enter numeric amount of letters you received'),
            outlook: yup.string().required().trim().matches('^[0-9]*$', 'please enter numeric amount of letters you received'),
            other: yup.string().required().trim().matches('^[0-9]*$', 'please enter numeric amount of letters you received'),
            received: yup.string().nullable().matches("^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$", 'valid date format is yyyy-mm-dd'),
        });

        const {errors, validate: validateForm} = useForm({
            validationSchema: schema.nullable()
        });

        const google = useField('google', {value: computed(() => props.letter.google)});
        const yahoo = useField('yahoo', {value: computed(() => props.letter.yahoo)});
        const outlook = useField('outlook', {value: computed(() => props.letter.outlook)});
        const other = useField('other', {value: computed(() => props.letter.other)});
        const received = useField('received_at', {value: computed(() => props.letter.received_at)});
        const hr = useField('hr', {value: computed(() => props.letter.hr_id)});
        const company = useField('company', {value: computed(() => props.letter.company_id)});

        const config = [
            {
                field: google,
                name: 'google'
            },
            {
                field: yahoo,
                name: 'yahoo'
            },
            {
                field: outlook,
                name: 'outlook'
            },
            {
                field: other,
                name: 'other'
            },
            {
                field: received,
                name: 'received_at'
            },
            {
                field: hr,
                name: 'hr_id'
            },
            {
                field: company,
                name: 'company_id'
            }
        ];

        const resetFormMeta = useResetForm();

        function resetForm() {
            resetFormMeta();

            [google, yahoo, outlook, other].forEach(field => {
                field.value.value = 0;
            });
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1;
            let yyyy = today.getFullYear();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            received.value.value = yyyy + '-' + mm + '-' + dd;
            hr.value.value = null;
            company.value.value = null;

            config.forEach(item => {
                props.letter[item.name] = item.field.value.value;
            });
        }

        emitter.on('create-letter-form', resetForm);
        emitter.on('edit-letter-form', setValues);

        async function validate() {
            config.forEach(item => {
                item.field.meta.dirty = true;
                item.field.meta.touched = true;
                item.field.value.value = props.letter[item.name];
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
            resetFormMeta();
            config.forEach(item => item.field.value.value = props.letter[item.name]);
        }

        onBeforeUnmount(() => {
            emitter.off('create-letter-form', resetForm);
            emitter.off('edit-letter-form', setValues);
        })

        return {
            schema, errors, validate,
            google, yahoo, outlook, other, received, hr, company,
            hrs: computed(() => store.getters.getHrs),
            companies: computed(() => store.getters.getCompanies),
            profile: computed(() => store.getters.getProfile),
        }
    },
    props: {letter: Object},
};
</script>

