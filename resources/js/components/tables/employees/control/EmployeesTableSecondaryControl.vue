<template>
    <div class="d-flex align-items-center mb-3">
        <DeleteButton/>
        <UpdateButton/>
        <ExportButton/>
    </div>
</template>

<script>
    import DeleteButton from '../actions/DeleteSelectedButton'
    import UpdateButton from '../actions/UpdateSelectedButton'
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

<style scoped>

</style>