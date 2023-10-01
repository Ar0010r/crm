<template>
    <div class="container-fluid flex-grow-1 container-p-y">

        <h4 class="font-weight-bold py-3 mb-4">
            Dashboard
            <div class="text-muted text-tiny mt-1"><small class="font-weight-normal">Today is Tuesday, 8 February
                2018</small></div>
        </h4>

        <!-- Counters -->
        <StatsCounters/>
<!--        <div class="row">
            <div class="col-sm-6 col-xl-3">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="lnr lnr-cart display-4 text-success"></div>
                            <div class="ml-3">
                                <div class="text-muted small">New added</div>
                                <div class="text-large">2362</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="lnr lnr-earth display-4 text-info"></div>
                            <div class="ml-3">
                                <div class="text-muted small">Hired</div>
                                <div class="text-large">687,123</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="lnr lnr-gift display-4 text-danger"></div>
                            <div class="ml-3">
                                <div class="text-muted small">Emails Sent</div>
                                <div class="text-large">985</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="lnr lnr-upload display-4 text-warning"></div>
                            <div class="ml-3">
                                <div class="text-muted small">Emails recieved</div>
                                <div class="text-large">105,652</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>-->
        <!-- / Counters -->

        <div class="card mb-4">
           <StatsChart/>
        </div>
        <div class="row">
            <div class="col-md-6">

                <!-- Sale stats -->
                <div class="card mb-4">
                    <h6 class="card-header with-elements">
                        <div class="card-header-title">Total</div>
                        <div class="card-header-elements ml-auto">
                            <StatsTotalControl/>
                        </div>
                    </h6>
                    <div class="table-responsive">
                        <StatsTable/>
                    </div>
                </div>
                <!-- / Sale stats -->

            </div>
            <div class="d-flex col-md-6 align-items-stretch">

                <TotalsBlock/>
                <!-- Stats + Links -->
<!--                <div class="card d-flex w-100 mb-4">
                    <div class="row no-gutters row-bordered h-100">
                        <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                            <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                                <i class="lnr lnr-chart-bars display-4 d-block text-primary"></i>
                                <span class="media-body d-block ml-3">
                          <span class="text-big font-weight-bolder">5000</span><br>
                          <small class="text-muted">Emails received</small>
                        </span>
                            </a>

                        </div>
                        <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                            <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                                <i class="lnr lnr-hourglass display-4 d-block text-primary"></i>
                                <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">4.2%</span> Index</span><br>
                          <small class="text-muted">420 leads hired</small>
                        </span>
                            </a>

                        </div>
                        <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                            <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                                <i class="lnr lnr-checkmark-circle display-4 d-block text-primary"></i>
                                <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">27%</span> Bounce</span><br>
                          <small class="text-muted">5371 leads added to the system</small>
                        </span>
                            </a>

                        </div>
                        <div class="d-flex col-sm-6 col-md-4 col-lg-6 align-items-center">

                            <a href="javascript:void(0)" class="card-body media align-items-center text-body">
                                <i class="lnr lnr-license display-4 d-block text-primary"></i>
                                <span class="media-body d-block ml-3">
                          <span class="text-big"><span class="font-weight-bolder">12%</span> Conversion</span><br>
                          <small class="text-muted">Procentage of hired leads to all leads</small>
                        </span>
                            </a>

                        </div>
                    </div>
                </div>-->
                <!-- / Stats + Links -->

            </div>
        </div>
        <div class="card mb-4">
            <IndexChart/>
        </div>
    </div>
</template>

<script>
import StatisticsTableBundle from '../components/Statistics/Content';
import {useStore} from 'vuex';
import StatsChart from "../components/Analytics/StatsChartBlock";
import IndexChart from "../components/Analytics/IndexChartBlock";
import Control from "../components/Analytics/StatsChartControl";
import {computed} from "vue";
import StatsCounters from "../components/Analytics/StatsCounters";
import StatsTable from "../components/Analytics/StatsTable";
import StatsTotalControl from "../components/Analytics/StatsTotalControl";
import TotalsBlock from "../components/Analytics/TotalsBlock";

export default {
    setup() {
        let store = useStore();
        let noDailyAnalytics = Object.keys(store.getters.getDailyAnalytics).length === 0;
        let noIndexAnalytics = Object.keys(store.getters.getIndexAnalytics).length === 0;
        let noHrAnalytics = Object.keys(store.getters.getHrAnalytics).length === 0;
        let noManagers = Object.keys(store.getters.getManagers).length === 0;
        const today = new Date();

// Calculate the date for the start of last week (7 days ago)
        const lastWeekStartDate = new Date(today);
        lastWeekStartDate.setDate(today.getDate() - 7);

        const halfYear = new Date(today);
        halfYear.setDate(today.getDate() - 180);

// Format the date as "YYYY-MM-DD"
        const formattedLastWeekStartDate = `${lastWeekStartDate.getFullYear()}-${(lastWeekStartDate.getMonth() + 1).toString().padStart(2, '0')}-${lastWeekStartDate.getDate().toString().padStart(2, '0')}`;
        const formattedHalfYear = `${halfYear.getFullYear()}-${(halfYear.getMonth() + 1).toString().padStart(2, '0')}-${halfYear.getDate().toString().padStart(2, '0')}`;
        const formattedStartYear = `${halfYear.getFullYear()}-01-01`;

        store.dispatch('analytics/getToday');
        store.commit('analytics/setQueryParam', {'key': 'daily_from', 'value': formattedLastWeekStartDate})
        store.commit('analytics/setQueryParam', {'key': 'total_from', 'value': formattedStartYear})
        store.commit('analytics/setQueryParam', {'key': 'index_from', 'value': formattedStartYear})
        if (noDailyAnalytics) store.dispatch('analytics/getDaily', {from:formattedLastWeekStartDate});
        if (noHrAnalytics) store.dispatch('analytics/getTotal', {from:formattedStartYear});
        if (noIndexAnalytics) store.dispatch('analytics/getIndex', {from:formattedStartYear});
        if (noManagers) store.dispatch('manager/get');

        return {
            records: computed(() => store.getters.getDailyAnalytics),
            params: computed(() => store.getters.getConversionQueryParams),
        }

    },
    components: {
        StatsTotalControl,
        StatsTable,
        TotalsBlock,
        StatsCounters,
        StatsChart,
        Control,
        IndexChart
    }
};
</script>
