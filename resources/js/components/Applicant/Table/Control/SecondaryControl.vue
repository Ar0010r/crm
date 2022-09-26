<template>
    <div class="d-flex align-items-center mb-3">
        <DeleteButton/>
        <UpdateButton/>
        <ContactButton/>
    </div>
</template>

<script>
import DeleteButton from '../../../Applicant/Table/Control/DeleteSelectedButton'
import UpdateButton from '../../../Applicant/Table/Control/UpdateSelectedButton'
import ContactButton from '../../../Applicant/Table/Control/ContactSelectedButton'

export default {
    name: "SelectedEmployeesControl",
    components: {
        DeleteButton,
        UpdateButton,
        ContactButton
    }
}
</script>
