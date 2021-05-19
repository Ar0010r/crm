<template>
    <tr class="d-flex">
        <td class="col-3">{{user.login}}</td>
        <td class="col-3">{{allCount}}</td>
        <td class="col-3">{{exportedCount}}</td>
        <td v-if="exportedCount>0" class="col-3">{{Math.round(exportedCount/allCount * 100)}}%</td>
        <td class="col-3" v-else> 0% </td>
    </tr>
</template>

<script>
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        props: {user: Object},
        setup(props) {
            const store = useStore();

            const all = computed(() => {
                const employees = {...store.getters.getEmployees};
                const companies = {...store.getters.getCompanies};
                let companyIds = [];

                Object.keys(companies).map(key => {
                    if(companies[key].personnel_id === props.user.id) companyIds.push(companies[key].id)
                });

                Object.keys(employees).map(key => {
                    if(companyIds.includes(employees[key].company_id)) return ;
                    else delete employees[key];
                })

                return employees
            })

            const exported = computed(() => {
                let allEmployees = {...all.value}
                Object.keys(allEmployees).map(key => {

                    if (allEmployees[key].status !== 'Exported') delete allEmployees[key]
                })

                return allEmployees
            })

            return {
                allCount: computed(() => Object.keys(all.value).length),
                exportedCount: computed(() => Object.keys(exported.value).length),

            }
        },
    };
</script>
