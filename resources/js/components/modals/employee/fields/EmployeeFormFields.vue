<template>
    <h1>{{employee.name}}</h1>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name" v-model='employee.name'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Email</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" v-model='employee.email'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">PayPal</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" v-model='employee.paypal'>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Company</label>
            <select v-model=employee.company_id class="custom-select form-control form-control-sm col form-group m-0 col-md-10">
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
            <input type="text" class="form-control col-md-10" placeholder="Address" v-model=employee.address>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">City</label>
            <input type="text" class="form-control col-md-10" placeholder="City" v-model=employee.city>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">State</label>
            <input type="text" class="form-control col-md-10" placeholder="State" v-model=employee.state>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Zip</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXXX-XXXX" v-model=employee.zip>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" v-model=employee.phone_1>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone 2</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" v-model=employee.phone_2>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Birthday</label>
            <input type="text" class="form-control col-md-10" placeholder="dd/mm/yyyy" v-model=employee.birthday>
            <div class="invalid-tooltip">Please provide a valid state.</div>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Race</label>
            <select v-model=employee.race class="custom-select form-control form-control-sm col-md-10">
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

            watch(() => props.employee, (first, second) => {
                console.log(
                    "Watch props.selected function called with args:",
                    first,
                    second
                );
            });

            return {
                races: computed(() => useStore().getters.getRaces),
                companies: computed(() => useStore().getters.getCompanies),
            }
        },

        props: {employee: Object}
    };
</script>
