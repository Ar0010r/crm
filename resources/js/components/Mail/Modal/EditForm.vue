<template>
    <Form id="editMailForm"
          title="Update mail"
          purpose="update"
          getter="getMailModel"
          dispatch="mail/update"
          :open="open"
          :validate="validate"
          message="mail was updated"
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
                open : "edit-mail-form",
                validate : "validate-edit-form"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
