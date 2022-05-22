<template>
    <div class="modal-body">
        <Input v-model="object.name"
               :vmodel="object.name"
               :validate="validate"
               :reset="reset"
               label="name"
               regex='^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$'
               :required=true
        />
        <Input v-model="object.email"
               :vmodel="object.email"
               :validate="validate"
               :reset="reset"
               label="email"
               regex='email'
               :required=true
        />
        <Input v-model="object.paypal"
               :vmodel="object.paypal"
               :validate="validate"
               :reset="reset"
               label="paypal"
               regex='email'
        />
        <Select :options=companies
                title="select delivery company"
                label="delivery"
                :vmodel=object.company_id
                v-model="object.company_id"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=hrCompanies
                title="select hr company"
                label="hiring"
                :vmodel=object.hr_company_id
                v-model="object.hr_company_id"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Input v-model="object.address"
               :vmodel="object.address"
               :validate="validate"
               :reset="reset"
               label="address"
        />
        <Input v-model="object.city"
               :vmodel="object.city"
               :validate="validate"
               :reset="reset"
               label="city"
        />
        <StateInput
            v-model="object.state"
            :vmodel="object.state"
            :validate="validate"
            :reset="reset"
            :values=states
            label="state"
        />
        <Input v-model="object.zip"
               :vmodel="object.zip"
               :validate="validate"
               :reset="reset"
               placeholder="xxxxx-xxxx"
               label="zip"
               regex="^\d{5}(-\d{4})?$"
        />
        <Input v-model="object.phone_1"
               :vmodel="object.phone_1"
               :validate="validate"
               :reset="reset"
               label="phone 1"
               placeholder="xxx-xxx-xxxx"
               regex="^\d{3}-\d{3}-\d{4}$"
        />
        <Input v-model="object.phone_2"
               :vmodel="object.phone_2"
               :validate="validate"
               :reset="reset"
               label="phone 2"
               placeholder="xxx-xxx-xxxx"
               regex="^\d{3}-\d{3}-\d{4}$"
        />
        <Input v-model="object.birthday"
               :vmodel="object.birthday"
               :validate="validate"
               :reset="reset"
               placeholder="yyyy-mm-dd"
               label="birthday"
               regex="^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$"
        />
        <Select :options=races()
                title="select race"
                label="race"
                :vmodel=object.race
                v-model="object.race"
                :reset="reset"
                :validate="validate"
        />
        <Checkbox label="available for pick up"
                  :vmodel=object.pickup
                  v-model="object.pickup"
        />
    </div>
</template>

<script>
import Select from '../../../abstract/Modal/Fields/Select.vue';
import Input from '../../../abstract/Modal/Fields/Input.vue';
import Checkbox from '../../../abstract/Modal/Fields/Checkbox.vue';
import StateInput from '../../../abstract/Modal/Fields/SpecialValuesInput.vue';
import {useStore} from 'vuex';
import {computed, inject} from 'vue';

export default {
    props: {object: Object, reset: String, validate: String},
    setup() {
        const store = useStore()
        const container = inject('container')
        return {
            companies: computed(() => container.CompanyService.delivery(store.getters.getCompanies)),
            hrCompanies: computed(() => container.CompanyService.hr(store.getters.getCompanies)),
            races: function () {
                return store.getters.getRaces.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })
            },
            results: [{"name": "inbox", "id": 1}, {"name": "spam", "id": 0}],
            states: ['AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY']
        }
    },
    components: {
        Select,
        StateInput,
        Checkbox,
        Input,
    }
};
</script>
