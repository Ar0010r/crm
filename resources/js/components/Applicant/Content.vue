<template>
  <Template title="Applicants">
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
    import Control from './Table/Control/Wrapper';
    import Table from './Table/Wrapper';

    export default {
        components: {
            Template,
            Control,
            Table,
        }
    };
</script>
