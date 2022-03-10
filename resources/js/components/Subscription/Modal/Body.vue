<service>
   <div class="modal-body">
        <Select :options=companies
                title="select company"
                label="company"
                :vmodel=object.company_id
                v-model="object.company_id"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=providers()
                title="select provider"
                label="provider"
                :vmodel=object.provider
                v-model="object.provider"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=services()
                title="select service"
                label="service"
                :vmodel=object.service
                v-model="object.service"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
       <Select :options=periods()
               title="select payment period"
               label="period"
               :vmodel=object.period
               v-model="object.period"
               :required="true"
               :reset="reset"
               :validate="validate"
       />
       <Input v-model="object.price"
              :vmodel="object.price"
              :validate="validate"
              :reset="reset"
              label="price"
              regex='(\d+\.\d{1,2})'
              :required=true />

        <DateInput
            :vmodel="object.last_payment"
            :reset="reset"
            :validate="validate"
            label="last payment"
        />
    </div>
</service>

<script>
    import Select from '../../../abstract/Modal/Fields/Select.vue';
    import Input from '../../../abstract/Modal/Fields/Input.vue';
    import DateInput from '../../../abstract/Modal/Fields/DateInput.vue';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {object:Object, reset:String, validate:String},
        setup() {
            const store = useStore()
            return {
                companies: computed(() => store.getters.getCompanies),
                providers: function () {
                    return store.getters.getProviders.map(function (value) {
                        return {
                            "id": value,
                            "name": value
                        }
                    })
                },
                services: function () {
                    return store.getters.getServices.map(function (value) {
                        return {
                            "id": value,
                            "name": value
                        }
                    })
                },
                periods: function () {
                    return store.getters.getPeriods.map(function (value) {
                        return {
                            "id": value,
                            "name": value
                        }
                    })
                }
            }
        },
        components: {
            Select,
            Input,
            DateInput,
        }
    };
</script>
