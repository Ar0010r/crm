<template>
    <table class="table table-striped table-bordered m-0">
        <Head :columns="columns"></Head>
        <tbody>
        <slot></slot>
        </tbody>
    </table>
</template>

<script>
import Head from './Head';

export default {
    props: {columns: Array},
    components: {
        Head,
    }
};
</script>
