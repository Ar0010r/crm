<template>
    <a data-toggle="modal" data-target="#editCompanyForm">
        <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                data-toggle="tooltip" data-target="#editCompanyForm"
                data-placement="right" title="Edit"
                @click="showEditCompanyForm"
        >
        </button>
    </a>
</template>

<script>
    import {inject} from 'vue';

    export default {
        setup(props) {
            const emitter = inject("emitter");

            return {
                showEditCompanyForm: () => emitter.emit('edit-company-form', props.company)
            }
        },
        props: {
            company: Object
        },
    };
</script>
