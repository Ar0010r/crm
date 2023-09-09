<template>
    <div v-if="show" style="white-space: nowrap;">
        <small>contact : </small><small class="font-weight-bold" :class="contacted.style">{{contacted.label}}</small>
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
                contacted: computed(() => {
                    let response = {'style' : "text-danger", 'label' : "2 days +"};
                    let hours = moment().diff(props.applicant.contacted, 'hours');

                    if(hours <= 1) {
                        response.style = "text-success";
                        response.label = "recent"
                    }

                    if(hours > 1 && hours <= 10) {
                        response.style = "text-success";
                        response.label = "today"
                    }

                    if(hours > 10 && hours <= 24) {
                        response.style = "text-orange";
                        response.label = hours + " h"
                    }

                    if(hours > 24 && hours <= 48) {
                        response.style = "text-orange";
                        response.label = "24 h +"
                    }

                    return response;

                }),

                show: computed(() => {
                    let canSee = store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr' || store.getters.getProfile.role === 'admin';
                    let needShow = props.applicant.status == 'Need data';

                    return canSee && needShow
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
