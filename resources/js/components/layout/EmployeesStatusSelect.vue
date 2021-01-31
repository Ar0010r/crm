<template>
    <div class="btn-group  w-100">
        <button type="button" class="btn btn dropdown-toggle" :class="statuses[status]"
                data-toggle="dropdown">{{status}}
        </button>
        <div class="dropdown-menu m-0 p-0 w-100 text-center">
            <a v-for="(cssClass, status) in statuses" :key="status" @click='activateStatus(id, status)'
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
    import {computed, ref, watch} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup(props) {
            let watchedStatus = watch(() => props.status, (first, second) => {
                render().setup();
                return second ?? first
            });

            return {
                statuses: computed(() => useStore().getters.getStatuses),
                employeeStatus: ref(watchedStatus())
            }
        },

        methods: {
            async activateStatus(id, newStatus) {
                this.$store.commit('setEmployeeStatus', {id: id, newStatus: newStatus});
                axios.put('api/employees/' + this.id, {status: newStatus});
            }
        },
        props: ['status', 'id', 'updateOnSelect'],
    };
</script>



