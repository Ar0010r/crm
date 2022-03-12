<template>
    <div class="modal-body">
        <Select
            v-if="profileIsAdmin"
            :options=hrs
            title="select hr"
            label="hr"
            name="login"
            :vmodel=object.hr_id
            v-model="object.hr_id"
            :required="true"
            :reset="reset"
            :validate="validate"
        />
        <Select :options=companies
                title="select company"
                label="company"
                :vmodel=object.company_id
                v-model="object.company_id"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <IntegerInput v-model="object.google" :vmodel="object.google" :reset="reset" :validate="validate" label="google"
                      :required="true"/>
        <IntegerInput v-model="object.yahoo" :vmodel="object.yahoo" :reset="reset" :validate="validate" label="yahoo"
                      :required="true"/>
        <IntegerInput v-model="object.outlook" :vmodel="object.outlook" :reset="reset" :validate="validate"
                      label="outlook" :required="true"/>
        <IntegerInput v-model="object.other" :vmodel="object.other" :reset="reset" :validate="validate" label="other"
                      :required="true"/>
        <DateInput v-model="object.received_at" :vmodel="object.received_at" :reset="reset" :validate="validate"
                   :required="true" label="received"/>
        <IntegerInput v-model="object.processed" :vmodel="object.processed" :reset="reset" :validate="validate"
                      :required="true" label="processed"/>
    </div>
</template>

<script>
import Select from '../../../abstract/Modal/Fields/Select.vue';
import Input from '../../../abstract/Modal/Fields/Input.vue';
import DateInput from '../../../abstract/Modal/Fields/DateInput.vue';
import IntegerInput from '../../../abstract/Modal/Fields/IntegerInput.vue';
import {useStore} from 'vuex';
import {computed, inject} from 'vue';

export default {
    props: {
        object: Object,
        reset: String,
        validate: String,
        requirePassword: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        const store = useStore()
        const container = inject('container')

        return {
            hrs: computed(() => store.getters.getHrs),
            companies: computed(() => container.CompanyService.delivery(store.getters.getCompanies)),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin' || store.getters.getProfile.role === 'top hr'
            }),
        }
    },
    components: {
        IntegerInput,
        DateInput,
        Input,
        Select,
    }
};
</script>
