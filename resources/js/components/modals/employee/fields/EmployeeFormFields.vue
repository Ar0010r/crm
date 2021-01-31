<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name" :value=employee.name>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">Email</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" :value=employee.email>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2 ">PayPal</label>
            <input type="email" class="form-control col-md-10" placeholder="email@gmail.com" :value=employee.paypal>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Company</label>
            <select class="custom-select form-control form-control-sm col form-group m-0 col-md-10">
                <option disabled selected value> -- select company --</option>
                <option v-for="company in companies" :value='company.id' :selected='employee.company.name === company.name'>
                    {{company.name}}
                </option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Address</label>
            <input type="text" class="form-control col-md-10" placeholder="Address" :value=employee.address>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">City</label>
            <input type="text" class="form-control col-md-10" placeholder="City" :value=employee.city>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">State</label>
            <input type="text" class="form-control col-md-10" placeholder="State" :value=employee.state>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Zip</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXXX-XXXX" :value=employee.zip>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" :value=employee.phone_1>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Phone 2</label>
            <input type="text" class="form-control col-md-10" placeholder="XXXX-XXX-XXX" :value=employee.phone_2>
        </div>
    </div>
    <div class="form-row mb-2 ">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Birthday</label>
            <input type="text" class="form-control col-md-10" placeholder="dd/mm/yyyy" :value=employee.birthday>
            <div class="invalid-tooltip">Please provide a valid state.</div>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Race</label>
            <select class="custom-select form-control form-control-sm col-md-10">
                <option disabled selected value> -- select race --</option>
                <option v-for="race in races" :selected='employee.race === race'>{{race}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import {computed} from 'vue'
    import {useStore} from 'vuex'

    export default {
        setup() {
            /*let racesAreUndefined = Object.keys(useStore().state.races).length === 0;
            let companiesAreUndefined = Object.keys(useStore().state.companies).length === 0;
            if (racesAreUndefined) useStore().commit('setRaces');
            if (companiesAreUndefined) useStore().commit('setCompanies');*/

            /*if (racesAreUndefined) {
                useStore().commit('setRaces');
            }
            if (companiesAreUndefined) {
                useStore().commit('setCompanies');
            }*/

            return {
                races : computed(() => useStore().getters.getRaces),
                companies : computed(() => useStore().getters.getCompanies),
            }
        },

        props: {employee: Object}
    };
</script>
