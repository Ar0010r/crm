<template>
    <HrRow v-if="profileIsHr"/>
    <AdminRow v-if="profileIsTopHr || profileIsAdmin" v-for="hr in hrs" :hr="hr"/>
    <tr v-if="profileIsAdmin" class="odd gradeX" style="border: black solid 1px">
        <td><strong>Total</strong></td>
        <td>{{ profile.admin_good_employees_count }}</td>
        <td>{{ profile.admin_letters_count }}</td>
        <td v-if="profile.admin_good_employees_count>0">
            {{(profile.admin_good_employees_count/profile.admin_letters_count * 100).toFixed(2)}}%
        </td>
        <td v-else> 0%</td>
    </tr>
</template>

<script>
import AdminRow from './layouts/AdminHrStatisticsTableRow';
import HrRow from './layouts/HrStatisticsTableRow';
import {useStore} from 'vuex';
import {computed} from 'vue';

export default {
    setup() {
        const store = useStore();

        return {
            profile: computed(() => store.getters.getProfile),
            hrs: computed(() => store.getters.getHrs),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),
            profileIsTopHr: computed(() => {
                return store.getters.getProfile.role === 'top hr'
            }),
            profileIsHr: computed(() => {
                return store.getters.getProfile.role === 'hr'
            })
        }
    },
    props: {letter: Object},
    components: {
        AdminRow,
        HrRow
    }
};
</script>
