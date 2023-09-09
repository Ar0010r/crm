<template>
    <table class="table card-table">
        <thead>
        <tr>
            <th>HR</th>
            <th>Hired</th>
            <th>New</th>
            <th>Emails</th>
            <th>Conv.</th>
            <th>Bounce</th>
            <th>Index</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="record in data">
            <td>{{record.hr}}</td>
            <td>{{record.hired}}</td>
            <td>{{record.new}}</td>
            <td>{{record.emails}}</td>
            <td>{{record.conversion}}%</td>
            <td>{{record.bounce}}%</td>
            <td>{{record.index}}%</td>
        </tr>
        </tbody>
    </table>
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
            data: computed(() => store.getters.getHrAnalytics)
        }
    },
}
</script>
