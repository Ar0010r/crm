<template>
    <Template title="Statistics">
        <template v-slot:control>
            <Control />
        </template>
        <template v-slot:table>
            <Table/>
        </template>
    </Template>

</template>

<script>
import Template from '../../abstract/Template';
import Control from './Control';
import Table from './Wrapper';

export default {
    components: {
        Template,
        Control,
        Table,
    }
};
</script>
