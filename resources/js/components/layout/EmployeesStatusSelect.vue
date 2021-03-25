<template>
    <div class="btn-group  w-100">
        <button type="button" class=" pl-0 pr-0 btn btn dropdown-toggle" :class="statuses[status]"
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
    import {computed, ref} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup(props) {
            let store = useStore();

            const activateStatus = (id, newStatus) => {
                store.commit('employee/setEmployeeStatus', {id: id, newStatus: newStatus});
                axios.put('api/employees/' + id, {status: newStatus});
            };

            return {
                statuses: computed(() => store.getters.getStatuses),
                employeeStatus: ref(props.status),
                activateStatus
            }
        },

        props: ['status', 'id', 'updateOnSelect'],
    };
</script>



