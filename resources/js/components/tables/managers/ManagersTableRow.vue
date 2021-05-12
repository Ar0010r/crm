<template>
    <tr :class="{ 'd-none': user.login === profile.login}">
        <td>{{user.created_at}}</td>
        <td>{{user.login}}</td>
        <td>{{user.role}}</td>
        <td class="d-flex justify-content-between align-items-center border-0"
        >
            <EditButton :user="user" />
            <DeleteButton :user="user" />
        </td>
    </tr>
</template>

<script>
    import DeleteButton from './actions/DeleteButton';
    import EditButton from './actions/EditButton';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup() {
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
            }
        },
        props: {user: Object},
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
