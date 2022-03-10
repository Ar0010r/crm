<template>
    <Form id="profileForm"
          title="Update profile"
          purpose="update"
          getter="getManagerModel"
          dispatch="manager/update"
          :open="open"
          :validate="validate"
          message="profile was updated"
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
                open : "edit-profile-form",
                validate : "validate-edit-profile"
            }
        },
        components: {
            Body,
            Form
        }
    };
</script>
