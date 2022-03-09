<template>
    <Form id="editTestForm"
          title="Update test"
          purpose="update"
          getter="getTestModel"
          dispatch="test/update"
          :open="open"
          :validate="validate"
          message="test was updated"
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
                open : "edit-test-form",
                validate : "validate-edit-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
