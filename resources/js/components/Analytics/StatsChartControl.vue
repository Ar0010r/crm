<template>
    <div class="d-flex justify-content-between align-content-center w-100">
        <Multiselect
            v-model="multi"
            :options="hrs"
            mode="tags"
            style="width: 40%; min-height:1rem; margin-right: .75rem; border-color: #ddd"
            placeholder="All hrs accounted"
        />
        <DatePicker
            classes="col-md d-flex align-content-center"
            :vmodel=filters.daily_from
            param="daily_from"
            commit="analytics/setQueryParam"
            placeholder="From"
            style="width: 30%; min-height: 1.5rem"
        />
        <DatePicker
            classes="col-md d-flex align-content-center"
            :vmodel=filters.daily_to
            param="daily_to"
            commit="analytics/setQueryParam"
            placeholder="To"
            style="width: 30%"
        />
    </div>
</template>

<script>
import DatePicker from "../../abstract/Table/Control/DatePicker";
import Multiselect from '@vueform/multiselect'
import {useStore} from "vuex";
import {computed, watch, ref} from "vue"
import analytics from "../../store/analytics";

export default {
    components: {DatePicker, Multiselect},
    setup() {
        const store = useStore();
        const filters = computed(() => store.getters.getDailyAnalyticsQueryParams);
        const hrs = computed(() => store.getters.getHrs);
        const multi = ref([]);

        watch(() => filters.value, (second, first) => {
            let params = {};
            if (second.daily_hrs) params.hrs = second.daily_hrs;
            if (second.daily_from) params.from = second.daily_from;
            if (second.daily_to) params.to = second.daily_to;

            store.dispatch("analytics/getDaily", params);
        }, {deep: true});

        watch(() => multi.value, (second, first) => {
            store.commit('analytics/setQueryParam', {'key': 'daily_hrs', 'value': second})
        }, {deep: true});

        return {
            multi,
            filters,
            hrs: computed(function () {
                let result = [];
                let obj = hrs.value ?? {};
                Object.keys(obj).map(i => result.push({value: i, label: hrs.value[i].login}))

                return result;
            }),
        }
    },
}
</script>

<style src="@vueform/multiselect/themes/default.css">

</style>

<style>
.multiselect-wrapper{
    min-height: 2rem !important;
}
</style>
