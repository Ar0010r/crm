<template>
  <Template title="Mails" :styling="styling">
      <template v-slot:control>
          <Breadcrumbs v-if="profileIsAdmin"/>
          <Control v-if="showHistory"/>
      </template>
      <template v-slot:table>
          <History v-if="showHistory"/>
          <Statistics v-if="showStatistics"/>
      </template>
  </Template>
</template>

<script>
    import Template from '../../abstract/Template';
    import Control from './Table/Control';
    import Breadcrumbs from './Table/Breadcrumbs';
    import History from './Table/History';
    import Statistics from './Table/Statistics';
    import {computed, inject, onBeforeUnmount, ref} from "vue";
    import {useStore} from "vuex";

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            let showStatistics = ref(false)
            let showHistory = ref(true)

            function statistics() {
                showStatistics.value = true
                showHistory.value = false
            }

            emitter.on('show-mail-statistics', statistics);
            onBeforeUnmount(() => emitter.off('show-mail-statistics', statistics));

            function history() {
                showStatistics.value = false
                showHistory.value = true
            }

            emitter.on('show-mail-history', history);
            onBeforeUnmount(() => emitter.off('show-mail-history', history));

            return {
                showStatistics, showHistory,
                profileIsAdmin: computed(() => {
                    return store.getters.getProfile.role === 'admin'
                }),
                styling: computed(() => {
                    if (store.getters.getProfile.role === 'admin') {
                        return "pt-3 mb-0"
                    }

                    return 'py-3 mb-4';
                }),
            }

        },
        components: {
            Breadcrumbs,
            Template,
            Control,
            History,
            Statistics,
        }
    };
</script>
