<template>
    <tr class="odd gradeX">
        <td  class="col-2">{{hr.login}}</td>
        <td class="col-2" >{{hr.google_total ?? 0}}</td>
        <td class="col-2" >{{hr.outlook_total ?? 0}}</td>
        <td class="col-2" >{{hr.yahoo_total ?? 0}}</td>
        <td class="col-2" >{{hr.other_total ?? 0}}</td>
        <td class="col-2" >{{total}}</td>
    </tr>
</template>

<script>
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
