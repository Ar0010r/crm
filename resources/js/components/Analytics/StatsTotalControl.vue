<template>
    <DatePicker
        classes="col-md d-flex align-content-center"
        :vmodel=filters.total_from
        param="total_from"
        commit="analytics/setQueryParam"
        placeholder="From"
    />
    <DatePicker
        classes="col-md d-flex align-content-center"
        :vmodel=filters.total_to
        param="total_to"
        commit="analytics/setQueryParam"
        placeholder="To"
    />
</template>

<script>
import DatePicker from "../../abstract/Table/Control/DatePicker";
import {useStore} from "vuex";
import {computed, watch} from "vue"

export default {
    components: {DatePicker},
    setup() {
        const store = useStore();
        const filters = computed(() => store.getters.getTotalAnalyticsQueryParams);

        watch(() => filters.value, (second, first) => {
            console.log('watch', 111111);
            store.dispatch("analytics/getTotal", second);
        },{ deep: true });

        return {filters}
    },
}
</script>
