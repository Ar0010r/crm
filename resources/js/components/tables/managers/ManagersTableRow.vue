<template>
    <tr class="odd gradeX">
        <td>{{user.created_at}}</td>
        <td>{{user.login}}</td>
        <td>{{user.role}}</td>
        <td>
            <a data-toggle="modal" data-target="#editManagerForm"   @click=putUserInfoToStore(user) >
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
    import{useStore} from 'vuex';
    export default {
        setup(props){
            const store = useStore();

            function putUserInfoToStore(user) {
                let object = {
                    id: user.id,
                    login: user.login,
                    role: user.role,
                    password: null,
                };

                store.commit('formData/setUser', object);
            }

            return { putUserInfoToStore }
        },
        props: {user: Object},
    };
</script>
