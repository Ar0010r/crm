<template>
    <div v-for="error in errors" class="growl growl-error growl-medium" :id="error.id">
        <div class="growl-close" @click="close(error.id)">×</div>
        <div class="growl-title">{{error.message.message}}</div>
        <div class="growl-message" v-for="errorMessage in error.message.errors">{{errorMessage[0]}}</div>
    </div>
</template>
<script>
    import {ref, inject} from 'vue';

    export default {
        setup() {
            const emitter = inject("emitter");
            let errors = ref([]);
            const delay = 5000;

            emitter.on('notification-error', showError);

            async function showError(message) {
                let id = Math.floor(Math.random() * 100)
                errors.value.push({
                    id: id,
                    message: message
                });

                setTimeout(() => close(id), delay);
            }

            async function close(id) {
                const error = document.getElementById(id);
                if(error){
                    error.classList.add('growl-outgoing');
                    setTimeout(() => errors.value = errors.value.filter(error => error.id !== id), delay/9);
                }
            }

            return {close}
        },
    };
</script>


