<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Manager</label>
            <select class="custom-select form-control form-control-sm col form-group m-0 col-md-10">
                <option disabled selected value> -- select manager --</option>
                <option value="25">Artek</option>
                <option value="50">Kate</option>
                <option value="100">Paris</option>
            </select>
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Name</label>
            <input type="text" class="form-control col-md-10" placeholder="Name">
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Domain</label>
            <input type="text" class="form-control col-md-10" placeholder="website.com">
        </div>
    </div>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between">
            <label class="form-label col-md-2">Email</label>
            <input type="email" class="form-control col-md-10" placeholder="Email">
        </div>
    </div>
</template>

<script>
    export default {
    };
</script>

