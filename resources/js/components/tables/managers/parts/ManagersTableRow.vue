<template>
    <tr class="d-flex" :class="{ 'd-none': user.login === profile.login}">
        <td class="col-3">{{user.created_at}}</td>
        <td class="col-4">{{user.login}}</td>
        <td class="col-3">{{user.role}}</td>
        <td class="d-flex col-2 justify-content-between align-items-center">
            <EditButton :user="user" />
            <DeleteButton :user="user" />
        </td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
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
