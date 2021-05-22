<template>
    <tr class="d-flex">
        <td class="col-3">{{user.login}}</td>
        <td class="col-3">{{user.personnel_employees_count}}</td>
        <td class="col-3">{{user.exported_personnel_employees_count}}</td>
        <td v-if="user.exported_personnel_employees_count>0" class="col-3">
            {{Math.round(user.exported_personnel_employees_count/user.personnel_employees_count * 100)}}%
        </td>
        <td class="col-3" v-else> 0% </td>
    </tr>
</template>

<script>
    export default {
        props: {user: Object},
    };
</script>
