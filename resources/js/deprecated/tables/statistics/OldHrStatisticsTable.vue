<template>
    <table class="datatables-demo table table-striped table-bordered">
        <HrStatisticsTableHead/>
        <tbody>
        <HrStatisticsTableRow/>
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
