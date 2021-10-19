<template>
    <p class="">AAABc</p>
    <table class="datatables-demo table table-striped table-bordered" v-for="hr in hrs">
        <thead>
        <tr>
            <th class="text-left font-weight-bold">Company {{hr.login}}</th>
            <th class="text-left font-weight-bold">Mails</th>
            <th class="text-left font-weight-bold">Hired</th>
            <th class="text-left font-weight-bold">%</th>
        </tr>
        </thead>
        <tbody>
        <tr class="odd gradeX">
            <td>company</td>
            <td>mails</td>
            <td>hired</td>
            <td>rate</td>
        </tr>
        <tr class="odd gradeX">
            <td>company</td>
            <td>mails</td>
            <td>hired</td>
            <td>rate</td>
        </tr>
        <tr class="odd gradeX">
            <td>company</td>
            <td>mails</td>
            <td>hired</td>
            <td>rate</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
import HrStatisticsTableHead from './HrStatisticsTableHead.vue';
import HrStatisticsTableRow from './HrStatisticsTableRow.vue';
import CreateLetterForm from '../../modals/letter/CreateLetterForm';
import EditLetterForm from '../../modals/letter/EditLetterForm';
import {computed} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();

        return {
            hrs: computed(() => store.getters.getHrs),
        }
    },

    components: {
        HrStatisticsTableHead,
        HrStatisticsTableRow,
        CreateLetterForm,
        EditLetterForm,
    }
};
</script>
