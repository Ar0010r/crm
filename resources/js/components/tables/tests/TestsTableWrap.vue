<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Tests
        </h4>
        <Control/>
        <div v-if="Object.keys(tests).length > 0" v-for="test in tests">
            <h3>{{ test.company }}</h3>
            <div>
                <TestsRecord class="col-7" :tests="test.results" />
            </div>
        </div>
        <NoRecords v-else />
    </div>
</template>

<script>
    import TestsTableHead from './TestsTableHead.vue';
    import Control from './control/TestsControl';
    import TestsTableRow from './TestsTableRow.vue';
    import TestsRecord from './TestsTable.vue';
    import NoRecords from '../../layout/NoRecords';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            function formatTest(tests) {
                let data = {};
                Object.keys(tests).forEach(function (key) {
                    const test = tests[key];

                    if(!data[test.company_id]) {
                        data[test.company_id] = {
                            'company' : test.company.name,
                            'results' : []
                        }
                    }

                    data[test.company_id].results.push(test)
                });

                return data;
            }
            return {
                tests: computed(() => formatTest(store.getters.getTests)),
            }
        },

        components: {
            TestsTableHead,
            TestsTableRow,
            TestsRecord,
            NoRecords,
            Control
        }
    };
</script>
