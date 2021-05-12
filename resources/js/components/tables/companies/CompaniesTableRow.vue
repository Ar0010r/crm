<template>
    <tr class="odd gradeX">
        <td>{{company.created_at}}</td>
        <td>{{company.personnel.login}}</td>
        <td>{{company.name}}</td>
        <td>{{company.domain}}</td>
        <td>{{company.email}}</td>
        <td v-if="profile.role === 'admin'"
            class="d-flex justify-content-between align-items-center border-0"
        >
            <EditButton :company="company" />
            <DeleteButton :company="company" />
        </td>
    </tr>
</template>

<script>
    import DeleteButton from './actions/DeleteButton';
    import EditButton from './actions/EditButton';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(){
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
            }
        },
        props: {company: Object},
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
