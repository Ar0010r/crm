<template>
    <div class="col-md mb-4">
        <label class="form-label">Last contact</label>
        <select class="custom-select" v-model="contacted" @change="handleContacted"
                :class="{ 'light-grey': contacted == null}">
            <option :value=null> Any</option>
            <option value="today">&lt 10 h</option>
            <option value="yesterday">10 h &lt 48 h</option>
            <option value="2 days +">&lt 48 h</option>
        </select>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {inject, onBeforeUnmount, ref} from "vue";
import moment from "moment";

export default {
    setup() {
        const store = useStore();
        const emitter = inject("emitter");
        const contacted = ref(null)

        function reset() {
            contacted.value = null
        }

        emitter.on('reset-controls', reset);
        onBeforeUnmount(() => emitter.off('reset-controls', reset));

        const setToday = () => {
            moment.locale('en-ca');
            let tenAgoDate = moment().subtract(10, 'hours').format('L');

            moment.locale('fr');
            let tenAgoTime = moment().subtract(10, 'hours').format('LTS');

            store.commit('applicant/setQueryParam', {'key': 'contacted_after', 'value': tenAgoDate + " " + tenAgoTime})
            store.commit('applicant/setQueryParam', {'key': 'contacted_before', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'contacted_between', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'status', 'value': "Need data"})
        };
        const setYesterday = () => {
            moment.locale('en-ca');
            let tenAgoDate = moment().subtract(10, 'hours').format('L');
            let twentyForAgoDate = moment().subtract(48, 'hours').format('L');

            moment.locale('fr');
            let tenAgoTime = moment().subtract(10, 'hours').format('LTS');
            let twentyForAgoTime = moment().subtract(48, 'hours').format('LTS');

            store.commit('applicant/setQueryParam', {'key': 'contacted_after', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'status', 'value': "Need data"})
            store.commit('applicant/setQueryParam', {'key': 'contacted_before', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'contacted_between', 'value': twentyForAgoDate + " " + twentyForAgoTime + "," + tenAgoDate + " " + tenAgoTime})

        };
        const setTwoDays = () => {
            moment.locale('en-ca');
            let fortyEightAgoDate = moment().subtract(48, 'hours').format('L');

            moment.locale('fr');
            let fortyEightAgoTime = moment().subtract(48, 'hours').format('LTS');

            store.commit('applicant/setQueryParam', {'key': 'contacted_before', 'value': fortyEightAgoDate + " " + fortyEightAgoTime})
            store.commit('applicant/setQueryParam', {'key': 'contacted_after', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'contacted_between', 'value': null})
            store.commit('applicant/setQueryParam', {'key': 'status', 'value': "Need data"})
        };
        return {
            contacted,
            handleContacted: () => {
                if (contacted.value === "today") {
                    return setToday()
                }

                if (contacted.value === "yesterday") {
                    return setYesterday()
                }

                if (contacted.value === "2 days +") {
                    return setTwoDays()
                }

                store.commit('applicant/setQueryParam', {'key': 'contacted_before', 'value': null})
                store.commit('applicant/setQueryParam', {'key': 'contacted_after', 'value': null})
                store.commit('applicant/setQueryParam', {'key': 'contacted_between', 'value': null})
                store.commit('applicant/setQueryParam', {'key': 'status', 'value': null})
            },
        }
    }
};
</script>


<style lang="scss">
.light-grey {
    color: #babbbc
}
</style>
