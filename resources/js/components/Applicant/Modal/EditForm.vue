<template>
    <Form id="editApplicantForm"
          title="Update applicant"
          purpose="update"
          getter="getApplicantModel"
          dispatch="applicant/update"
          :open="open"
          :validate="validate"
          message="applicant was updated"
    >
        <template #default="scope">
            <Body :object="scope.object" :reset="open" :validate="validate"/>
        </template>
    </Form>
</template>

<script>
    import Body from './Body';
    import Form from '../../../abstract/Modal/Form';
    export default {
        setup() {
            return {
                open : "edit-applicant-form",
                validate : "validate-edit-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
