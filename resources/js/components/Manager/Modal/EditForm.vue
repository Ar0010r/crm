<template>
    <Form id="editManagerForm"
          title="Update manager"
          purpose="update"
          getter="getManagerModel"
          dispatch="manager/update"
          :open="open"
          :validate="validate"
          message="manager was updated"
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
                open : "edit-manager-form",
                validate : "validate-edit-manager"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
