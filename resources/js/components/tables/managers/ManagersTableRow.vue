<template>
    <tr :class="{ 'd-none': user.login === profile.login}">
        <td>{{user.created_at}}</td>
        <td>{{user.login}}</td>
        <td>{{user.role}}</td>
        <td>
            <a data-toggle="modal" data-target="#editManagerForm" @click=showEditManagerForm>
                <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                        data-toggle="tooltip"
                        data-placement="right" title="Edit"

                >
                </button>
            </a>
        </td>
    </tr>
</template>

<script>
    import {useStore} from 'vuex';
    import {inject, computed} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                profile: computed(() => store.getters.getProfile),
                showEditManagerForm: () => emitter.emit('edit-manager-form', props.user)
            }
        },
        props: {user: Object},
    };
</script>
