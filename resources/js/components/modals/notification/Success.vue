<template>
    <div v-for="success in successes" class="growl bg-success growl-incoming growl-medium text-center" :id="success.id">
        <div class="growl-close" @click="close(success.id)">×</div>
        <div class="growl-title text-white">{{success.message}}</div>
    </div>
</template>
<script>
    import {ref, inject} from 'vue';

    export default {
        setup() {
            const emitter = inject("emitter");
            let successes = ref([]);
            const delay = 4500;

            emitter.on('notification-success', showSuccess);

            async function showSuccess(message) {
                let id = setTimeout(() => close(id), delay);

                successes.value.push({
                    id: id,
                    message: message
                });

                setTimeout(() => document.getElementById(id).classList.remove('growl-incoming'), 500)

            }

            function close(id) {
                const success = document.getElementById(id);
                if (success) {
                    clearTimeout(id);
                    document.getElementById(id).classList.add('growl-outgoing');
                    setTimeout(() => document.getElementById(id).classList.add('d-none'), 500);
                }
            }

            return {close, delay, successes}
        },
    }
</script>


