<template>
    <div v-if="show" style="white-space: nowrap;">
        <small>hired : </small><small class="font-weight-bold text-success">{{applicant.hired_at}}</small>
    </div>
</template>

<script>
    import {useStore} from 'vuex'
    import moment from 'moment'
    import {inject, computed} from 'vue';
    export default {
        setup(props) {
            const store = useStore();

            return {
                show: computed(() => {
                    let canSee = store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr' || store.getters.getProfile.role === 'admin';
                    let needShow = props.applicant.status === 'Ready' || props.applicant.status === 'Invited' || props.applicant.status === 'Exported';

                    return props.applicant.hired_at != null && canSee && needShow
                }),

            }
        },
        props: {
            applicant: Object
        },
    }
</script>

<style scoped>
    .text-orange {
        color:#FC8A17;
    }

</style>
