<template>
    <Form id="createApplicantForm"
          title="Create applicant"
          purpose="create"
          getter="getApplicantModel"
          dispatch="applicant/create"
          :open="open"
          :validate="validate"
          message="applicant was created"
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
                open : "create-applicant-form",
                validate : "validate-create-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
