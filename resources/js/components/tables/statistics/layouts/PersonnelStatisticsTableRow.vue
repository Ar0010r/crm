<template>
    <tr class="odd gradeX">
        <td class=" pr-0">Month</td>
        <td class="" >Company</td>
        <td class="" >Total</td>
        <td class="" >Need data</td>
        <td class="" >Ready</td>
        <td class="" >Invited</td>
        <td class="" >Bad</td>
        <td class="" >Exported</td>
    </tr>
</template>

<script>
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {letter: Object},
        setup(props){
            return {
                total: computed(() =>
                    parseInt(props.letter.google) +
                    parseInt(props.letter.outlook) +
                    parseInt(props.letter.yahoo) +
                    parseInt(props.letter.other)
                ),
            }
        }
    };
</script>
