<template>
    <tr class="odd gradeX">
        <td>{{hr.login}}</td>
        <td>{{ hr.good_hr_employees_count }}</td>
        <td class="mails">{{ total }}</td>
        <td v-if="hr.good_hr_employees_count>0" class="col-3">
            {{(hr.good_hr_employees_count/total * 100).toFixed(2)}}%
        </td>
        <td class="col-3" v-else> 0%</td>
    </tr>
</template>

<script>
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {hr: Object},
        setup(props){
            return {
                total: computed(() =>
                    parseInt(props.hr.google_total ?? 0) +
                    parseInt(props.hr.outlook_total ?? 0) +
                    parseInt(props.hr.yahoo_total ?? 0) +
                    parseInt(props.hr.other_total ?? 0)
                ),
            }
        }
    };
</script>
