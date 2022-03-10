<template>
    <Form id="createSubscriptionForm"
          title="Create subscription"
          purpose="create"
          getter="getSubscriptionModel"
          dispatch="subscription/create"
          :open="open"
          :validate="validate"
          message="subscription was created"
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
                open : "create-subscription-form",
                validate : "validate-create-subscription"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
