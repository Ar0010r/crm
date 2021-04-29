<template>
    <div v-for="warning in warnings" class="growl growl-warning growl-medium text-center" :id="warning.id">
        <div class="growl-close" @click="close(warning.message.event_id, warning.id)">×</div>
        <div class="growl-title">{{warning.message.message}}</div>
        <div class="growl-message">will be deleted in {{delay/1000}} seconds</div>
        <button class="btn btn-warning align-center" @click="disappear(warning.id)">Undo</button>
    </div>
</template>
<script>
    import {ref, inject} from 'vue';

    export default {
        setup() {
            const emitter = inject("emitter");
            let warnings = ref([]);
            const delay = 7000;

            emitter.on('delete-warning', showWarning);

            async function showWarning(message) {
                let id = Math.floor(Math.random() * 100);
                warnings.value.push({
                    id: id,
                    message: message
                });

                setTimeout(() => close(message.event_id, id), delay);
            }

            function close(event_id, div_id) {
                emitDeleteEvent(event_id, div_id);
                disappear(div_id);
            }

            function disappear(div_id) {
                const warning = document.getElementById(div_id);
                if(warning) {
                    document.getElementById(div_id).classList.add('growl-outgoing');
                    setTimeout(() => warnings.value = warnings.value.filter(warning => warning.id !== div_id), 500);
                }
            }

            function emitDeleteEvent(event_id, div_id) {
                const warning = document.getElementById(div_id);
                if(warning) emitter.emit('delete-employee-' + event_id)
            }

            return {disappear, close, delay, warnings}
        },
    };
</script>


