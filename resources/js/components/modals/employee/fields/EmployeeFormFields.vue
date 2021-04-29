<template>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Name</label>
            <input type="text" class="form-control col-md-10 " name="name" placeholder="Name"
                   v-model="employee.name"
                   :class="{ 'is-invalid': !!nameError}" />
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!nameError}">{{nameError}}</label>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Email</label>
            <input type="email" class="form-control col-md-10" name="email" placeholder="email@gmail.com"
                   :class="{ 'is-invalid': !!emailError}" v-model='employee.email' />
        </div>
        <label class="float-right text-danger d-none align-self-end"
               :class="{ 'd-block': !!emailError}">{{emailError}}</label>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">PayPal</label>
            <input type="email" class="form-control col-md-10" name="paypal" placeholder="paypal@gmail.com"
                   :class="{ 'is-invalid': !!paypalError}" v-model='employee.paypal' />
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!paypalError}">{{paypalError}}</label>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Company</label>
            <select :class="{ 'is-invalid': !!companyError && meta.dirty}" v-model=employee.company_id name="company"
                    class="custom-select form-control form-control-sm col form-group m-0 col-md-10">
                <option disabled selected value> -- select company --</option>
                <option v-for="company in companies" :value='company.id'
                        :selected='employee.company.name === company.name'>
                    {{company.name}}
                </option>
            </select>
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!companyError && meta.dirty}">{{companyError}}</label>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Address</label>
            <input type="text" class="form-control col-md-10" placeholder="Address" name="address"
                   v-model=employee.address />
        </div>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">City</label>
            <input type="text" class="form-control col-md-10" placeholder="City" name="city" v-model=employee.city />
        </div>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">State</label>
            <input type="text" class="form-control col-md-10" placeholder="State" name="state"
                   :class="{ 'is-invalid': !!stateError}"
                   v-model=employee.state />
        </div>
        <label class="float-right text-danger d-none align-self-end"
               :class="{ 'd-block': !!stateError}">{{stateError}}</label>
    </div>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Zip</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXXX-XXXX" name="zip"
                   :class="{ 'is-invalid': !!zipError}" v-model=employee.zip />
        </div>
        <label class="float-right text-danger d-none align-self-end"
               :class="{ 'd-block': !!zipError}">{{zipError}}</label>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone</label>
            <input type="text" class="form-control col-md-10" placeholder="XXX-XXX-XXXX" name="phone_1"
                   :class="{ 'is-invalid': !!phone_1Error}" v-model=employee.phone_1 />
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!phone_1Error}">{{phone_1Error}}</label>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone 2</label>
            <input type="text" class="form-control col-md-10" placeholder="XXX-XXX-XXXX" name="phone_2"
                   :class="{ 'is-invalid': !!phone_2Error}" v-model=employee.phone_2 />
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!phone_2Error}">{{phone_2Error}}</label>
    </div>
    <div class="form-row mb-2  d-flex flex-column">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Birthday</label>
            <input type="text" class="form-control col-md-10" placeholder="yyyy-mm-dd" name="birthday"
                   :class="{ 'is-invalid': !!birthdayError}" v-model=employee.birthday />
        </div>
        <label class="float-right text-danger d-none align-self-end" :class="{ 'd-block': !!birthdayError}">{{birthdayError}}</label>
    </div>
    <div class="form-row mb-4 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Race</label>
            <select v-model=employee.race class="custom-select form-control form-control-sm col-md-10" name="race">
                <option disabled selected value> -- select race --</option>
                <option v-for="race in races" :selected='employee.race === race'>{{race}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import {computed, watch} from 'vue';
    import {useStore} from 'vuex';
    import {useForm, useIsFormDirty, useField} from 'vee-validate';
    import * as yup from 'yup';


    export default {
        setup(props) {

            const uSstates = ['AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY'];

            const schema = yup.object({
                name: yup.string().nullable().trim().matches('^$|[a-zA-Z ]+$', 'Name can contain only letters'),
                email: yup.string().nullable().trim().email(),
                paypal: yup.string().nullable().trim().email(),
                company: yup.number().nullable(true).integer().default(),
                zip: yup.string().nullable().matches('^$|\\d{5}(-\\d{4})?$', 'Enter valid zip code'),
                phone_1: yup.string().nullable().matches('^$|\\d{3}-\\d{3}-\\d{4}$', 'Enter valid phone'),
                phone_2: yup.string().nullable().matches("^$|\\d{3}-\\d{3}-\\d{4}$", 'Enter valid phone'),
                birthday: yup.string().nullable().matches("^$|((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$",'Valid date format is yyyy-mm-dd'),
                state: yup.string().nullable().test("test-name", "Please enter correct state abbreviation",
                    function (value) {
                        return !!uSstates.includes(value) || value === ""|| value === null
                    }),
            });

            const {values, meta } = useForm({
                validationSchema: schema.nullable()
            });

            const {value: name, errorMessage: nameError} = useField('name', {
                validateOnValueUpdate: false,
            });
            const {value: email, errorMessage: emailError} = useField('email');
            const {value: paypal, errorMessage: paypalError} = useField('paypal');
            const {value: company, errorMessage: companyError, handleInput} = useField('company');
            const {value: address, errorMessage: addressError} = useField('address');
            const {value: city, errorMessage: cityError} = useField('city');
            const {value: state, errorMessage: stateError} = useField('state');
            const {value: zip, errorMessage: zipError} = useField('zip');
            const {value: phone_1, errorMessage: phone_1Error} = useField('phone_1');
            const {value: phone_2, errorMessage: phone_2Error} = useField('phone_2');
            const {value: birthday, errorMessage: birthdayError} = useField('birthday');

            name.value = computed(() => props.employee.name);
            email.value = computed(() => props.employee.email);
            paypal.value = computed(() => props.employee.paypal);
            company.value = computed(() => props.employee.company_id);
            address.value = computed(() => props.employee.address);
            city.value = computed(() => props.employee.city);
            state.value = computed(() => props.employee.state);
            zip.value = computed(() => props.employee.zip);
            phone_1.value = computed(() => props.employee.phone_1);
            phone_2.value = computed(() => props.employee.phone_2);
            birthday.value = computed(() => props.employee.birthday);

            const store = useStore();

            watch(meta, (first, second) => {

                //store.commit('formData/setEmployeeIsValidState', meta.value.valid)
                props.employee.dataIsValid = meta.value.valid

                /*console.log('from watcher ' + meta.value.valid);
                console.log(
                    "Watch props.selected function called with args:",
                    first,
                    second
                );*/
            });

            return {
                email, emailError,name, nameError, paypal, paypalError, address, addressError, city, cityError,
                state, stateError, zip, zipError, phone_1, phone_1Error, phone_2, phone_2Error, birthday, birthdayError,
                company, companyError, values, meta, handleInput,
                races: computed(() => store.getters.getRaces),
                companies: computed(() => store.getters.getCompanies),
            }
        },

        props: {employee: Object},
    };
</script>
