<template>
    <div class="row">
        <div class="col-sm-6 col-xl-3"  v-for="record in records">
            <StatsCounter :value="record.value" :style="record.style" :label="record.label"></StatsCounter>
        </div>
    </div>
</template>

<script>
import StatsCounter from "./StatsCounter";
import {useStore} from 'vuex';
import {computed} from "vue";

export default {
    components: {StatsCounter},

    setup() {
        const store = useStore();
        const data = computed(() => store.getters.getTodayAnalytics);

        // lnr lnr-earth display-4 text-info
        // lnr lnr-gift display-4 text-danger
        // lnr lnr-upload display-4 text-warning

        return {
            records: computed(() => [
                {
                    "label" : "New",
                    "value" : data.value.new,
                    //"value" : Math.max(data.value.new),
                    "style": "lnr lnr-cart display-4 text-success"
                },
                {
                    "label" : "Hired",
                    "value" : data.value.hired,
                    //"value" : Math.max(data.value.hired),
                    "style": "lnr lnr-earth display-4 text-info"
                },
                {
                    "label" : "Sent",
                    "value" : data.value.sent,
                    //"value" : Math.max(data.value.hired),
                    "style": "lnr lnr-gift display-4 text-danger"
                },
                {
                    "label" : "Bounce",
                    "value" : data.value.bounce + '%',
                    //"value" : Math.max(data.value.bounce),
                    "style": "lnr lnr-upload display-4 text-warning"
                }
            ]),
        }
    },
    props: {
        label: {
            type: String,
        },
        value: String,
        style: String,
    }
}
</script>
