<template>
    <h6 class="card-header with-elements justify-content-between">
        <div class="card-header-title">Daily</div>
        <div style="width: 60%" class="d-flex align-content-center">
            <Control />
        </div>
    </h6>
    <div class="row no-gutters row-bordered">
        <div class="col-md-9 col-lg-12 col-xl-9">
            <div class="card-body">
                <div style="height: 24rem">
                    <StatsChart/>
                    <!--                            <canvas id="statistics-chart-1"></canvas>-->
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-12 col-xl-3">
            <div class="card-body">

                <!-- Numbers -->
                <div class="row">
                    <div class="col-6 col-xl-5 text-muted mb-3">Total new leads</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{newAdded}}</span>
<!--                        <sup class="text-success">+12%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">Total hired</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{hired}}</span>
<!--                        <sup class="text-danger">-5%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">1st wave sent</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{sent_1}}</span>
<!--                        <sup class="text-success">+12%</sup>-->
                    </div>

                    <div class="col-6 col-xl-5 text-muted mb-3">2nd wave sent</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{sent_2}}</span>
                        <!--                        <sup class="text-success">+12%</sup>-->
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">Bounce</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">{{bounce}}%</span>
<!--                        <sup class="text-danger">-12%</sup>-->
                    </div>
                </div>
                <!-- / Numbers -->

            </div>
        </div>
    </div>
</template>

<script>
import StatsChart from "./StatsChart";
import Control from "./StatsChartControl";
import {ref, computed} from "vue";

import {useStore} from "vuex";

export default {
    name: "StatsChartBlock",
    components: {StatsChart, Control},
    setup() {

        const store = useStore();
        const data = computed(() => store.getters.getDailyAnalytics)
        return {
            newAdded: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.new ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total = i > total ? i : total)

                return total;
            }),
            hired: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.hired ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total = i > total ? i : total)

                return total;
            }),
            bounce: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.bounce ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total = i > total ? i : total)

                return total;
            }),
            sent_1: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.sent_1 ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total += i)

                return total;
            }),
            sent_2: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.sent_2 ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total += i)

                return total;
            }),
            index: computed(function () {
                let value = data.value ?? {};
                let addedStats = value.index ?? {};
                let total = 0;
                Object.values(addedStats).forEach(i => total += i)

                return total;
            })

        }
    }
}
</script>
