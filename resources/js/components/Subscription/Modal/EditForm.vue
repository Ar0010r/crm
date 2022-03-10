<template>
    <Form id="editSubscriptionForm"
          title="Update subscription"
          purpose="update"
          getter="getSubscriptionModel"
          dispatch="subscription/update"
          :open="open"
          :validate="validate"
          message="subscription was updated"
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
                open : "edit-subscription-form",
                validate : "validate-edit-subscription"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
