<template>
    <a data-toggle="modal" data-target="#editCompanyForm">
        <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0" :disabled="disabled()"
                data-toggle="tooltip" data-target="#editCompanyForm"
                data-placement="right" title="Edit"
                @click="showEditCompanyForm"
        >
        </button>
    </a>
</template>

<script>
import {computed, inject} from 'vue';
import {useStore} from "vuex";

    export default {
        setup(props) {
            const emitter = inject("emitter");
            const store = useStore();
            const profile = computed(() => store.getters.getProfile)

            return {
                showEditCompanyForm: () => emitter.emit('edit-company-form', props.company),
                disabled: function () {
                    if(profile.value.role == 'hr' || profile.value.role == 'top hr') {
                        if(props.company.type == 0) {
                            return true
                        }
                    }
                    return false
                },
            }
        },
        props: {
            company: Object
        },
    };
</script>
