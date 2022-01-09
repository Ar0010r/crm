<template>
    <table class="datatables-demo table table-striped table-bordered">
        <TestsTableHead/>
        <tbody>
        <TestsTableRow v-for="test in tests" :test="test" :key="test.id + test.name"/>
        </tbody>
    </table>
</template>

<script>
    import TestsTableHead from './TestsTableHead.vue';
    import TestsTableRow from './TestsTableRow.vue';

    export default {
        props: {tests: Array},

        components: {
            TestsTableHead,
            TestsTableRow,
        }
    };
</script>
