<template>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between wrap">
            <label class="form-label col-md-2 ">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name"
                   name="name"
                   v-model="employee.name"
                   @focus="name.meta.touched = false"
                   @input="name.handleChange"
                   @blur="name.handleBlur"
                   :class="{ 'is-invalid': !!errors.name && name.meta.touched}"/>
        </div>
        <small :class="{ 'd-block': !!errors.name && name.meta.touched}" class="invalid-feedback text-right p-0">
            {{errors.name}}
        </small>

    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Email</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com"
                   name="email"
                   v-model='employee.email'
                   @focus="email.meta.touched = false"
                   @input="email.handleChange"
                   @blur="email.handleBlur"
                   :class="{ 'is-invalid': !!errors.email && email.meta.touched}"/>
        </div>
        <small :class="{ 'd-block': !!errors.email && email.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.email}}
        </small>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">PayPal</label>
            <input type="email" class="form-control col-md-10" placeholder="paypal@gmail.com"
                   name="paypal"
                   v-model='employee.paypal'
                   @focus="paypal.meta.touched = false"
                   @input="paypal.handleChange"
                   @blur="paypal.handleBlur"
                   :class="{'is-invalid': !!errors.paypal   && paypal.meta.touched}"/>
        </div>
        <small :class="{ 'd-block': !!errors.paypal && paypal.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.paypal}}
        </small>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Company</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="company"
                    v-model=employee.company_id
                    @focus="company.meta.touched = false"
                    @change=company.handleChange
                    @blur="company.handleBlur"
                    :class="{'is-invalid': !!errors.company  && company.meta.touched}"
            >
                <option disabled selected :value=null> -- select company --</option>
                <option v-for="company in companies"
                        :value='company.id'
                        :selected='company.id === employee.company_id'>
                    {{company.name}}
                </option>
            </select>
        </div>
        <small :class="{'d-block': !!errors.company && company.meta.touched}" class="invalid-feedback text-right p-0">
            {{errors.company}}
        </small>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Address</label>
            <input type="text" class="form-control col-md-10" placeholder="Address"
                   name="address"
                   v-model=employee.address
                   @focus="address.meta.touched = false"
                   @blur="address.handleBlur"
                   @input="address.handleChange"
                   :class="{'is-invalid': !!errors.address   && address.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.address && address.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.address}}
        </small>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">City</label>
            <input type="text" class="form-control col-md-10" placeholder="City"
                   name="city"
                   v-model=employee.city
                   @focus="city.meta.touched = false"
                   @blur="city.handleBlur"
                   @input="city.handleChange"
                   :class="{'is-invalid': !!errors.city  && city.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.city && city.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.city}}
        </small>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">State</label>
            <input type="text" class="form-control col-md-10" placeholder="State"
                   name="state"
                   v-model=employee.state
                   @focus="state.meta.touched = false"
                   @blur="state.handleBlur"
                   @input="state.handleChange"
                   :class="{'is-invalid': !!errors.state && state.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.state && state.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.state}}
        </small>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Zip</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXXX-XXXX"
                   name="zip"
                   v-model=employee.zip
                   @focus="zip.meta.touched = false"
                   @blur="zip.handleBlur"
                   @input="zip.handleChange"
                   :class="{'is-invalid': !!errors.zip && zip.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.zip && zip.meta.touched}" class="invalid-feedback text-right p-0">
            {{errors.zip}}
        </small>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone</label>
            <input type="text" class="form-control col-md-10" placeholder="XXX-XXX-XXXX"
                   name="phone_1"
                   v-model=employee.phone_1
                   @focus="phone_1.meta.touched = false"
                   @blur="phone_1.handleBlur"
                   @input="phone_1.handleChange"
                   :class="{'is-invalid': !!errors.phone_1 && phone_1.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.phone_1 && phone_1.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.phone_1}}
        </small>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone 2</label>
            <input type="text" class="form-control col-md-10" placeholder="XXX-XXX-XXXX"
                   name="phone_2"
                   v-model=employee.phone_2
                   @focus="phone_2.meta.touched = false"
                   @blur="phone_2.handleBlur"
                   @input="phone_2.handleChange"
                   :class="{'is-invalid': !!errors.phone_2 && phone_2.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.phone_2 && phone_2.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.phone_2}}
        </small>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Birthday</label>
            <input type="text" class="form-control col-md-10" placeholder="yyyy-mm-dd"
                   name="birthday"
                   v-model=employee.birthday
                   @focus="birthday.meta.touched = false"
                   @blur="birthday.handleBlur"
                   @input="birthday.handleChange"
                   :class="{'is-invalid': !!errors.birthday && birthday.meta.touched}"
            />
        </div>
        <small :class="{ 'd-block': !!errors.birthday && birthday.meta.touched}"
               class="invalid-feedback text-right p-0">
            {{errors.birthday}}
        </small>
    </div>
    <div class="form-row mb-4 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Race</label>
            <select class="custom-select form-control form-control-sm col-md-10"
                    name="race"
                    v-model=employee.race
                    @focus="race.meta.touched = false"
                    @change=race.handleChange
                    @blur="race.handleBlur"
                    :class="{'is-invalid': !!errors.race && race.meta.touched}"
            >
                <option disabled selected :value=null> -- select race --</option>
                <option v-for="race in races"
                        :value=race
                        :selected='employee.race === race'>
                    {{race}}
                </option>
            </select>
        </div>
        <small :class="{'d-block': !!errors.race && race.meta.touched}" class="invalid-feedback text-right p-0">
            {{errors.race}}
        </small>
    </div>
</template>

<script>
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';
    import {useForm, useField, useResetForm} from 'vee-validate';
    import * as yup from 'yup';

    export default {
        setup(props) {
            const emitter = inject("emitter");
            const store = useStore();
            const states = ['AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY'];

            const schema = yup.object({
                race: yup.string().nullable(),
                company: yup.string().nullable().required(),
                email: yup.string().nullable().trim().email().required(),
                paypal: yup.string().nullable().trim().email(),
                zip: yup.string().nullable().matches('^\\d{5}(-\\d{4})?$', 'enter valid zip code'),
                phone_1: yup.string().nullable().matches('^\\d{3}-\\d{3}-\\d{4}$', 'enter valid phone'),
                phone_2: yup.string().nullable().matches("^\\d{3}-\\d{3}-\\d{4}$", 'enter valid phone'),
                name: yup.string().nullable().trim().matches('^[a-zA-Z ]+$', 'name can contain only letters').required(),
                city: yup.string().nullable().trim().matches('^$|[a-zA-Z ]+$', 'city can contain only letters'),
                birthday: yup.string().nullable().matches("^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$", 'valid date format is yyyy-mm-dd'),
                state: yup.string().nullable().test("test-name", "please enter correct state abbreviation",
                    function (value) {
                        return !!states.includes(value) || value === undefined
                    }),
            });

            const {values, errors, validate: validateForm} = useForm({
                validationSchema: schema.nullable()
            });

            const zip = useField('zip', {value: computed(() => props.employee.zip)});
            const race = useField('race', {value: computed(() => props.employee.race)});
            const name = useField('name', {value: computed(() => props.employee.name)});
            const city = useField('city', {value: computed(() => props.employee.city)});
            const email = useField('email', {value: computed(() => props.employee.email)});
            const state = useField('state', {value: computed(() => props.employee.state)});
            const paypal = useField('paypal', {value: computed(() => props.employee.paypal)});
            const phone_1 = useField('phone_1', {value: computed(() => props.employee.phone_1)});
            const phone_2 = useField('phone_2', {value: computed(() => props.employee.phone_2)});
            const address = useField('address', {value: computed(() => props.employee.address)});
            const birthday = useField('birthday', {value: computed(() => props.employee.birthday)});
            const company = useField('company', {value: computed(() => props.employee.company_id)});

            const resetForm = useResetForm();

            emitter.on('edit-employee-form', resetForm);
            emitter.on('create-employee-form', resetForm);

            async function validate() {
                [name, email, company].forEach(field => {
                    field.meta.dirty = true;
                    field.meta.touched = true;
                    if(field === company){
                        field.value.value = props.employee.company_id;
                    } else {
                        field.value.value = props.employee[field.name];
                    }
                })
                const result = await validateForm();
                if (!result.valid) {
                    throw ({
                        message: 'Please fix form errors:',
                        errors: Object.keys(result.errors).map(key => [result.errors[key]])
                    })
                }
            }

            return {
                validate, errors, values, schema,
                races: computed(() => store.getters.getRaces),
                companies: computed(() => store.getters.getCompanies),
                zip, race, name, city, email, state, paypal, phone_1,
                phone_2, address, birthday, company,
            }
        },

        props: {employee: Object},
    };
</script>
