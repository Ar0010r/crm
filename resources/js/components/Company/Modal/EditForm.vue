<template>
    <Form id="editCompanyForm"
          title="Update company"
          purpose="update"
          getter="getCompanyModel"
          dispatch="company/update"
          :open="open"
          :validate="validate"
          message="company was updated"
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
                open : "edit-company-form",
                validate : "validate-edit-company"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
