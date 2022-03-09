<template>
    <Form id="createTestForm"
          title="Create test"
          purpose="create"
          getter="getTestModel"
          dispatch="test/create"
          :open="open"
          :validate="validate"
          message="test was created"
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
                open : "create-test-form",
                validate : "validate-create-test"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
