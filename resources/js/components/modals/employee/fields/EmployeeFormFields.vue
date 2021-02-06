<template>
    <h1>{{formData.name}}</h1>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name" v-model='formData.name'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Email</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" v-model='formData.email'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">PayPal</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" v-model='formData.paypal'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Company</label>
            <select v-model=formData.company_id class="custom-select form-control form-control-sm col form-group m-0 col-md-10">
                <option disabled selected value> -- select company --</option>
                <option v-for="company in companies" :value='company.id'
                        :selected='employee.company.name === company.name'>
                    {{company.name}}
                </option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Address</label>
            <input type="text" class="form-control col-md-10" placeholder="Address" v-model=formData.address>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">City</label>
            <input type="text" class="form-control col-md-10" placeholder="City" v-model=formData.city>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">State</label>
            <input type="text" class="form-control col-md-10" placeholder="State" v-model=formData.state>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Zip</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXXX-XXXX" v-model=formData.zip>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" v-model=formData.phone_1>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone 2</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" v-model=formData.phone_2>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Birthday</label>
            <input type="text" class="form-control col-md-10" placeholder="dd/mm/yyyy" v-model=formData.birthday>
            <div class="invalid-tooltip">Please provide a valid state.</div>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Race</label>
            <select v-model=formData.race class="custom-select form-control form-control-sm col-md-10">
                <option disabled selected value> -- select race --</option>
                <option v-for="race in races" :selected='employee.race === race'>{{race}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import {computed, reactive, watch} from 'vue'
    import {useStore} from 'vuex'

    export default {
        setup(props) {
            let store = useStore();

            let companies = computed(() => useStore().getters.getCompanies);

            let formData = reactive(props.employee)

            /*let formData = reactive({
                id: props.employee.id,
                name: props.employee.name,
                email: props.employee.email,
                paypal: props.employee.paypal,
                company: props.employee.company.name,
                company_id: props.employee.company_id,
                address: props.employee.address,
                city: props.employee.city,
                state: props.employee.state,
                zip: props.employee.zip,
                phone_1: props.employee.phone_1,
                phone_2: props.employee.phone_2,
                birthday: props.employee.birthday,
                race: props.employee.race
            });*/

            watch(() => props.employee, (second, first) => {
                //formData = second;
                formData.id = second.id;
                formData.name = second.name;
                formData.email = second.email;
                formData.paypal = second.paypal;
                formData.company = second.company.company;
                formData.company_id = second.company_id;
                formData.address = second.address;
                formData.city = second.city;
                formData.state = second.state;
                formData.zip = second.zip;
                formData.phone_1 = second.phone_1;
                formData.phone_2 = second.phone_2;
                formData.birthday = second.birthday;
                formData.race = second.race;

            });

            watch(
                () => formData,
                (state, prevState) => {

                    let dataToCommit = state;
                    dataToCommit.company = companies._value[state.company_id]
                    store.commit('setEmployee', dataToCommit);
                },
                {deep: true}
            );

            return {
                formData: reactive(formData),
                races: computed(() => useStore().getters.getRaces),
                companies: companies
            }
        },

        props: {employee: Object}
    };
</script>
