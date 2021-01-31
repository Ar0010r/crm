<template>
    <div class="form-row mb-2 d-flex flex-column">
        <div class="form-row mb-2">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
                <label class="form-label col-md-2">Role</label>
                <select class="custom-select form-control form-control-sm col-md-10">
                    <option disabled selected value> -- select role --</option>
                    <option value="25">HR</option>
                    <option value="50">Personal</option>
                </select>
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
                <label class="form-label col-md-2">Login</label>
                <input type="text" class="form-control col-md-10" placeholder="Login">

            </div>
        </div>
        <div class="form-row mb-2">
            <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
                <label class="form-label col-md-2">Password</label>
                <input type="text" class="form-control col-md-10" placeholder="Password">
            </div>
        </div>
        <button type="button" class="btn btn-light w-25 align-self-end">Generate pass</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log("Component mounted.");
        },
    };
</script>

