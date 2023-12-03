<template>
    <h6 class="card-header with-elements justify-content-between">
        <div class="card-header-title">Index</div>
        <div style="width: 60%" class="d-flex align-content-center">
            <Control/>
        </div>
    </h6>
    <div class="row no-gutters row-bordered">
        <div class="col-md-9 col-lg-12 col-xl-9">
            <div class="card-body">
                <div style="height: 24rem">
                    <Chart/>
                    <!--                            <canvas id="statistics-chart-1"></canvas>-->
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-12 col-xl-3">
            <div class="card-body">

                <!-- Numbers -->
                <div class="row">
                    <div class="col-6 col-xl-5 text-muted mb-3">Index</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{ last_index }}%</span>
<!--                        <sup class="text-success">+12%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">R index</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{relative_index}}%</span>
<!--                        <sup class="text-danger">-5%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">Bounce</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{bounce}}%</span>
<!--                        <sup class="text-success">+12%</sup>-->
                    </div>

                    <div class="col-6 col-xl-5 text-muted mb-3">Conversion</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{conversion}}%</span>
                        <!--                        <sup class="text-success">+12%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">R Conversion</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{relative_conversion}}%</span>
<!--                        <sup class="text-danger">-12%</sup>-->
                    </div>
                </div>
                <!-- / Numbers -->

            </div>
        </div>
    </div>
</template>

<script>
import Chart from "./IndexChart";
//import Chart from "./Chart";
import Control from "./IndexChartControl";
import {ref, computed} from "vue";

import {useStore} from "vuex";

export default {
    name: "ChartBlock",
    components: {Chart, Control},
    setup() {

        const store = useStore();
        const data = computed(() => store.getters.getIndexAnalytics)
        return {
            last_index: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.index ?? {};
                let max = "";
                Object.keys(addedStats).forEach(i => max = i > max ? i : max)

                return Number((addedStats[max] ?? 0).toFixed(2));
            }),
            relative_index: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.relative_index ?? {};
                let max = "";
                Object.keys(addedStats).forEach(i => max = i > max ? i : max)

                return Number((addedStats[max] ?? 0).toFixed(2));
            }),
            bounce: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.bounce ?? {};
                let max = "";
                Object.keys(addedStats).forEach(i => max = i > max ? i : max)

                return Number((addedStats[max] ?? 0).toFixed(2));
            }),
            conversion: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.conversion ?? {};
                let max = "";
                Object.keys(addedStats).forEach(i => max = i > max ? i : max)

                return Number((addedStats[max] ?? 0).toFixed(2));
            }),
            relative_conversion: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.relative_conversion ?? {};
                let max = "";
                Object.keys(addedStats).forEach(i => max = i > max ? i : max)

                return Number((addedStats[max] ?? 0).toFixed(2));
            })
        }
    }
}
</script>
