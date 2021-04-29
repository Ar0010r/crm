<template>
    <tr class="odd gradeX">
        <td>{{company.created_at}}</td>
        <td>{{company.personnel.login}}</td>
        <td>{{company.name}}</td>
        <td>{{company.domain}}</td>
        <td>{{company.email}}</td>
        <td v-if="profile.role === 'admin'" >
            <a data-toggle="modal" data-target="#editCompanyForm">
                <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                        data-toggle="tooltip" data-target="#editCompanyForm"
                        data-placement="right" title="Edit"
                        @click="showEditCompanyForm"
                >

                </button>
            </a>
        </td>
    </tr>
</template>

<script>
    import{useStore} from 'vuex';
    import {computed, inject} from 'vue';

    export default {
        setup(props){
            const store = useStore();
            const emitter = inject("emitter");

            return {
                profile: computed(() => store.getters.getProfile),
                showEditCompanyForm: () => emitter.emit('edit-company-form', props.company)
            }
        },
        props: {company: Object},
    };
</script>
