<template>
    <div class="modal-body">
        <Select
            v-if="profileIsAdmin"
            :options=types
            title="select type"
            label="type"
            :vmodel=object.type
            v-model="object.type"
            :required="true"
            :reset="reset"
            :validate="validate"
        />
        <Select
            v-if="profileIsAdmin"
            :options=managers
            title="select manager"
            label="manager"
            name="login"
            :vmodel=object.manager_id
            v-model="object.manager_id"
            :required="true"
            :reset="reset"
            :validate="validate"
            :disabled="(object.type == null)"
        />
        <Input
            v-model="object.name"
            :vmodel="object.name"
            :validate="validate"
            :reset="reset"
            label="name"
            regex='^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$'
            :required=true
        />
        <Input
            v-model="object.domain"
            :vmodel="object.domain"
            :validate="validate"
            :reset="reset"
            label="domain"
            regex='^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$'
            :required=true
        />
        <Input
            v-model="object.pseudonym"
            :vmodel="object.pseudonym"
            :validate="validate"
            :reset="reset"
            label="pseudonym"
            regex='^[a-zA-Z ]*$'
            :required=true
        />
        <Input
            v-model="object.email"
            :vmodel="object.email"
            :validate="validate"
            :reset="reset"
            label="email"
            regex='email'
            :required=true
        />
        <Select
            :options=statuses
            title="select status"
            label="status"
            :vmodel=object.status
            v-model="object.status"
            :required="true"
            :reset="reset"
            :validate="validate"
        />
        <Select
            :options=scam
            title="select scam status"
            label="scam"
            :vmodel=object.scam
            v-model="object.scam"
            :required="true"
            :reset="reset"
            :validate="validate"
        />
    </div>
</template>

<script>
import Select from '../../../abstract/Modal/Fields/Select.vue';
import Input from '../../../abstract/Modal/Fields/Input.vue';
import {useStore} from 'vuex';
import {computed} from 'vue';

export default {
    props: {object: Object, reset: String, validate: String},
    setup(props) {
        const store = useStore()
        return {
            types: store.getters.getTypes,
            statuses: store.getters.getCompanyStatuses,
            scam: store.getters.getCompanyScam,
            managers: computed(() => props.object.type == 1 ? store.getters.getHrs : store.getters.getPersonnels),
            results: [{"name": "inbox", "id": 1}, {"name": "spam", "id": 0}],
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin' || store.getters.getProfile.role === 'top hr'
            }),
        }
    },
    components: {
        Select,
        Input,
    }
};
</script>
