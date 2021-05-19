<template>
    <tr class="d-flex">
        <td class="col-3">{{user.login}}</td>
        <td class="col-3">{{allCount}}</td>
        <td class="col-3">{{hiredCount}}</td>
        <td v-if="hiredCount>0" class="col-3">{{Math.round(hiredCount/allCount * 100)}}%</td>
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
                let employees = {...store.getters.getEmployees};

                Object.keys(employees).map(key => {
                    if (employees[key].hr_id !== props.user.id) delete employees[key]
                })

                return employees
            })

            const hired = computed(() => {
                let allEmployees = {...all.value}

                Object.keys(allEmployees).map(key => {
                    if ([
                        'Waiting agreement',
                        'New',
                        'Need data',
                        'Info',
                        'Bad',
                        'Died',
                    ].includes(allEmployees[key].status)
                    ) delete allEmployees[key]
                })

                return allEmployees
            })

            return {
                allCount: computed(() => Object.keys(all.value).length),
                hiredCount: computed(() => Object.keys(hired.value).length),
            }
        },
    };
</script>
