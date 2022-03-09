<template>
    <Datepicker v-model="date"></Datepicker>
</template>

<script>
import { ref } from 'vue';
import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css'

export default {
    components: { Datepicker },
    setup() {
        const date = ref();

        return {
            date
        }
    }
};
</script>
