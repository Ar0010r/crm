<template>
    <div id="growls-tr">
        <Warning/>
        <Error/>
        <Success/>
    </div>
</template>
<script>
    import Error from './Error';
    import Warning from './Warning';
    import Success from './Success';

    export default {
        components: {
            Error,
            Warning,
            Success
        }
    };
</script>


