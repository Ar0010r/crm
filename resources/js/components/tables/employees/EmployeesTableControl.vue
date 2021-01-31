<template>
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <select class="custom-select form-control form-control-sm ml-2">
                <option value="10">Company</option>
                <option value="10">Все</option>
                <option value="25">Prime</option>
                <option value="50">PerfectCourier</option>
                <option value="100">Other</option>
            </select>
            <select class="custom-select custom-select form-control-lg form-control-sm ml-2">
                <option value="10">Status</option>
                <option value="10">Все</option>
                <option value="10">Новый</option>
                <option value="25">Отправлен</option>
                <option value="50">Удален</option>
                <option value="100">Не отвечает</option>
            </select>
        </div>
        <div id="DataTables_Table_0_filter"
             class="col-md-4 dataTables_filter d-flex align-items-center justify-content-end ">
            <button type="button" data-toggle="modal" data-target="#storeEmployeeForm"
                    class="btn-primary btn w-auto col-sm-5">Add employee
            </button>
            <button type="button" data-toggle="modal" data-target="#fileInputForm"
                    class="btn-primary btn w-auto ml-2 col-sm-4">File upload
            </button>
            <select class="custom-select ml-2 col-md-4">
                <option value="10">Records</option>
                <option value="25">10</option>
                <option value="50">20</option>
                <option value="100">30</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
    };
</script>
