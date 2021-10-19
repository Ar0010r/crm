<template>
    <tr class="odd gradeX">
        <td  class="">hired</td>
        <td class="" >total</td>
        <td class="" >rate</td>
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
        },
    };
</script>
