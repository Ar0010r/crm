<template>
    <div class="form-row mb-4">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Status</label>

            <StatusSelect
                    :status.sync='currentEmployee.status'
                    :id.sync='currentEmployee.id'
                    :update-on-select.sync=false
            />
        </div>
    </div>
</template>


<script>
    import StatusSelect from '../../../layout/EmployeesStatusSelect.vue'
    import {computed} from 'vue'
    import {useStore} from 'vuex'
    export default {
        setup(props){
            //let employee = computed(() => useStore().getters.getEmployees[props.employee.id]);

            return{currentEmployee: computed(() => useStore().getters.getEmployees[props.employee.id])}
            //return{currentEmployee: reactive(employee)}
        },
        props: {employee: Object},
        components:{
            StatusSelect
        }
    };
</script>
