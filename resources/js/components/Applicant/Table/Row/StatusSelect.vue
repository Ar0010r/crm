<template>
    <div class="btn-group  w-100">
        <button type="button" class=" pl-1 pr-1 btn btn dropdown-toggle"
                :class="availableStatuses[status] ?? statuses[status]"
                data-toggle="dropdown">{{status}}
        </button>
        <div class="dropdown-menu m-0 p-0 w-100 text-center">
            <a v-for="(cssClass, status) in availableStatuses" :key="status" @click='activateStatus(id, status)'
               class="dropdown-item" :class="cssClass"
               href="javascript:void(0)"
            >
                {{status}}
            </a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {computed, ref} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup(props) {
            let store = useStore();

            const activateStatus = (id, newStatus) => {
                store.dispatch('applicant/updateStatus',{id: id, status: newStatus} )
            };

            return {
                statuses: computed(() => store.getters.getStatuses),
                availableStatuses: computed(() => store.getters.getAvailableStatuses),
                applicantStatus: ref(props.status),
                activateStatus
            }
        },

        props: ['status', 'id'],
    };
</script>



