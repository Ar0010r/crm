<template>
    <Form id="createCompanyForm"
          title="Create company"
          purpose="create"
          getter="getCompanyModel"
          dispatch="company/create"
          :open="open"
          :validate="validate"
          message="company was created"
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
                open : "create-company-form",
                validate : "validate-create-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
