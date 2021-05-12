<template>
    <div v-for="warning in warnings" class="growl growl-incoming growl-warning growl-medium text-center" :id="warning.id">
        <div class="growl-title">{{warning.message.message}}</div>
        <div class="growl-message">will be {{warning.message.action}} in {{delay/1000}} seconds</div>
       <div>
           <button class="btn btn-warning align-center" @click="disappear(warning.id)">Undo</button>
           <button class="btn btn-warning align-center" @click="close(warning.message.event_id, warning.id)">Delete</button>
       </div>
    </div>
</template>
<script>
    import {ref, inject} from 'vue';

    export default {
        setup() {
            const emitter = inject("emitter");
            let warnings = ref([]);
            const delay = 7000;

            emitter.on('notification-warning', showWarning);

            async function showWarning(message) {
                let id = setTimeout(() => close(message.event_id, id), delay);

                warnings.value.push({
                    id: id,
                    message: message
                });

                setTimeout(() => document.getElementById(id).classList.remove('growl-incoming'), 150)
            }

            function close(event_id, div_id) {
                emitDeleteEvent(event_id, div_id);
                disappear(div_id);
            }

            function disappear(id) {
                const warning = document.getElementById(id);
                if(warning) {
                    clearTimeout(id);
                    document.getElementById(id).classList.add('growl-outgoing');
                    setTimeout(() => document.getElementById(id).classList.add('d-none'), 500);
                }
            }

            function emitDeleteEvent(event_id, div_id) {
                const warning = document.getElementById(div_id);
                if(warning) emitter.emit(event_id)
            }

            return {disappear, close, delay, warnings}
        },
    };
</script>


