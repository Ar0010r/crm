<template>
    <div v-for="error in errors" class="growl growl-incoming growl-error growl-medium" :id="error.id">
        <div class="growl-close" @click="close(error.id)">×</div>
        <div class="growl-title" v-html="error.message.message"></div>
        <div class="growl-message" v-for="errorMessage in error.message.errors">{{errorMessage[0]}}</div>
    </div>
</template>
<script>
    import {ref, inject} from 'vue';

    export default {
        setup() {
            const emitter = inject("emitter");
            let errors = ref([]);
            const delay = 7000;
            const transition = 500;

            async function showError(message) {
                let id = setTimeout(() => close(id), delay);

                errors.value.push({
                    id: id,
                    message: message
                });

                setTimeout(() => document.getElementById(id).classList.remove('growl-incoming'), transition)
            }

            emitter.on('notification-error', showError);

            async function close(id) {
                const error = document.getElementById(id);
                if (error) {
                    error.classList.add('growl-outgoing');
                    setTimeout(() => document.getElementById(id).classList.add('d-none'), transition);
                }
            }

            return {errors, close}
        },
    };
</script>


