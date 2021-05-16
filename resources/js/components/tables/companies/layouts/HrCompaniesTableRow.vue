<template>
    <tr class="odd gradeX d-flex">
        <td class="col-1">{{company.created_at}}</td>
        <td class="col-2">{{company.name}}</td>
        <td class="col-3">{{company.domain}}</td>
        <td class="col-3">{{company.email}}</td>
        <td class="col-2">{{company.pseudonym}}</td>
        <td class="col-1">{{employeesCount}}</td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(props){
            const store = useStore();

            return {
                employeesCount: computed(() => {
                    const employees = {...store.getters.getEmployees};

                    Object.keys(employees).map(key => {
                        if (employees[key].company_id !== props.company.id) delete employees[key]
                    })

                    return Object.keys(employees).length
                }),
            }
        },
        props: {company: Object},
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
