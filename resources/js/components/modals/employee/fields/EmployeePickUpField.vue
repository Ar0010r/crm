<template>
    <div class="form-row mb-4">
        <div class="form-group col mb-0">
            <label class="form-check form-check-inline m-0 d-flex justify-content-end align-items-center">
                <input v-model="employee.pickup"
                       class="form-check-input"
                       type="checkbox"
                       true-value=1
                       false-value=0
                       >
                <span class="form-check-label">available for pick up</span>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        setup() {
            console.log("Component mounted.");
        },

        //props: {employeePickUp:},
        //props: ['employeePickUp'],
        props: {employee: Object},
    };
</script>
