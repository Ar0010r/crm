<template>
    <div class="d-flex align-items-center mb-3">
        <DeleteButton/>
        <UpdateButton/>
        <ExportButton/>
    </div>
</template>

<script>
    import DeleteButton from '../../../../components/Applicant/Table/Control/DeleteSelectedButton'
    import UpdateButton from '../../../../components/Applicant/Table/Control/UpdateSelectedButton'
    import ExportButton from '../actions/ExportSelectedButton'

    export default {
        name: "SelectedEmployeesControl",
        components: {
            DeleteButton,
            UpdateButton,
            ExportButton
        }
    }
</script>
