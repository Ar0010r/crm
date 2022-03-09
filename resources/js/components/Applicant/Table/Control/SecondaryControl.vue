<template>
    <div class="d-flex align-items-center mb-3">
        <DeleteButton/>
        <UpdateButton/>
    </div>
</template>

<script>
import DeleteButton from '../../../Applicant/Table/Control/DeleteSelectedButton'
import UpdateButton from '../../../Applicant/Table/Control/UpdateSelectedButton'

export default {
    name: "SelectedEmployeesControl",
    components: {
        DeleteButton,
        UpdateButton
    }
}
</script>
