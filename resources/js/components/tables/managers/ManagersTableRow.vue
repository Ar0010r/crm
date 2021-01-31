<template>
    <tr class="odd gradeX">
        <td>Artek</td>
        <td>01.01.2001</td>
        <td>Personal</td>
        <td>
            <a data-toggle="modal" data-target="#editManagerForm" class="p-5">
                <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                        data-toggle="tooltip" data-target="#editManagerForm"
                        data-placement="right" title="Edit">

                </button>
            </a>
        </td>
    </tr>
</template>

<script>
    export default {
        mounted() {
            console.log("Component mounted.");
        },
    };
</script>
