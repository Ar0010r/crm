<template>
    <Form id="createMailForm"
          title="Create mail"
          purpose="create"
          getter="getMailModel"
          dispatch="mail/create"
          :open="open"
          :validate="validate"
          message="mail record was stored"
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
                open : "create-mail-form",
                validate : "validate-create-mail"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
