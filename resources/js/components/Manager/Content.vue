<template>
  <Template title="Managers">
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
    import Control from './Table/Control';
    import Table from './Table/Wrapper';

    export default {
        components: {
            Template,
            Control,
            Table,
        }
    };
</script>
