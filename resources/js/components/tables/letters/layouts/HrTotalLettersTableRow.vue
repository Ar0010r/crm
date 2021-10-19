<template>
    <tr class="odd gradeX">
        <td class="col-2" >{{profile.google_total ?? 0}}</td>
        <td class="col-2" >{{profile.outlook_total ?? 0}}</td>
        <td class="col-2" >{{profile.yahoo_total ?? 0}}</td>
        <td class="col-2" >{{profile.other_total ?? 0}}</td>
        <td class="col-2" >{{total}}</td>
        <td class="col-2" >{{profile.good_hr_employees_count}}</td>
        <td v-if="profile.good_hr_employees_count>0" class="col-3">
            {{(profile.good_hr_employees_count/total * 100).toFixed(2)}}%
        </td>
        <td class="col-3" v-else> 0%</td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(){
            const store = useStore();
            let profile = computed(() => store.getters.getProfile);

            return {
                profile,
                total: computed(() =>
                    parseInt(profile.value.google_total ?? 0) +
                    parseInt(profile.value.outlook_total ?? 0) +
                    parseInt(profile.value.yahoo_total ?? 0) +
                    parseInt(profile.value.other_total ?? 0)
                ),
            }
        },
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
