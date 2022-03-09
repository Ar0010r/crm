<template>
    <table class="datatables-demo table table-striped table-bordered">
        <TotalLettersTableHead/>
        <tbody>
        <TotalLettersTableRow/>
        </tbody>
    </table>
</template>

<script>
    import TotalLettersTableHead from './TotalLettersTableHead.vue';
    import TotalLettersTableRow from './TotalLettersTableRow.vue';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
            }
        },

        components: {
            TotalLettersTableHead,
            TotalLettersTableRow
        }
    };
</script>
