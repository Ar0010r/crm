<template>
    <thead>
    <tr>
        <th v-for="column in columns"><strong>{{column}}</strong></th>
    </tr>
    </thead>
</template>

<script>
export default {
    props: {columns: Array},
};
</script>
