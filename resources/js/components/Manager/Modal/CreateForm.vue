<template>
    <Form id="createManagerForm"
          title="Create manager"
          purpose="create"
          getter="getManagerModel"
          dispatch="manager/create"
          :open="open"
          :validate="validate"
          message="manager was created"
    >
        <template #default="scope">
            <Body :object="scope.object" :reset="open" :validate="validate" :require-password=true />
        </template>
    </Form>
</template>

<script>
    import Body from './Body';
    import Form from '../../../abstract/Modal/Form';
    export default {
        setup() {
            return {
                open : "create-manager-form",
                validate : "validate-create-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
