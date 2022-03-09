<template>
    <tr class="odd gradeX">
        <td class="col-2">{{ record.period }}</td>
        <td class="col-1">{{ record.personnel }}</td>
        <td class="col-2">{{ record.company }}</td>
        <td class="col-1">{{ record.total }}</td>
        <td class="col-2">{{ record.need_data }}</td>
        <td class="col-1">{{ record.ready }}</td>
        <td class="col-1">{{ record.invited }}</td>
        <td class="col-1">{{ record.bad }}</td>
        <td class="col-1">{{ record.exported }}</td>
    </tr>
</template>

<script>
    export default {
        props: {record: Object}
    };
</script>
