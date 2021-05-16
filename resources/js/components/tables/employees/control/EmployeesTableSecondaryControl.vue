<template>
    <div class="d-flex align-items-center mb-3">
        <DeleteButton/>
        <UpdateButton/>
    </div>
</template>

<script>
    import DeleteButton from '../actions/DeleteSelectedButton'
    import UpdateButton from '../actions/UpdateSelectedButton'

    export default {
        name: "SelectedEmployeesControl",
        components: {
            DeleteButton,
            UpdateButton,
        }
    }
</script>

<style scoped>

</style>