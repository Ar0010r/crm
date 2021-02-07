<template>
    <div class="form-row mb-4">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Status</label>

            <StatusSelect v-if="emp.status"
                          :status.sync='emp.status'
                          :id.sync='employee.id'
            />
        </div>
    </div>
</template>


<script>
    import StatusSelect from '../../../layout/EmployeesStatusSelect.vue'
    import {computed, reactive} from 'vue'
    import {useStore} from 'vuex'
    import md5 from "js-md5";

    export default {
        setup(props) {
            return {emp: computed(() => useStore().getters.getEmployees[md5(props.employee.id.toString())])}
        },
        props: {employee: Object},
        components: {
            StatusSelect
        }
    };
</script>
