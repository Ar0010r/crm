<template>
    <div class="card d-flex w-100 mb-4">
        <div class="row no-gutters row-bordered h-100">
            <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                    <i class="lnr lnr-chart-bars display-4 d-block text-primary"></i>
                    <span class="media-body d-block ml-3">
                          <span class="text-big font-weight-bolder">{{data.emails}}</span><br>
                          <small class="text-muted">Emails received</small>
                        </span>
                </a>

            </div>
            <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                    <i class="lnr lnr-hourglass display-4 d-block text-primary"></i>
                    <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">{{data.index}}%</span> Index</span><br>
                          <small class="text-muted">420 leads hired</small>
                        </span>
                </a>

            </div>
            <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                    <i class="lnr lnr-checkmark-circle display-4 d-block text-primary"></i>
                    <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">{{data.bounce}}%</span> Bounce</span><br>
                          <small class="text-muted">5371 leads added to the system</small>
                        </span>
                </a>

            </div>
            <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                    <i class="lnr lnr-license display-4 d-block text-primary"></i>
                    <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">{{data.conversion}}%</span> Conversion</span><br>
                          <small class="text-muted">Procentage of hired leads to all leads</small>
                        </span>
                </a>

            </div>
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

        return {
            data: computed(() => store.getters.getTotalAnalytics)
        }
    },
}
</script>
