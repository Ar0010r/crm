<template>
    <div id="growls-tr">
        <Error/>
        <Warning/>
    </div>
</template>
<script>
    import Error from './Error';
    import Warning from './Warning';

    export default {
        components: {
            Error,
            Warning
        }
    };
</script>


