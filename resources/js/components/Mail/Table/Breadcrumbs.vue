<template>
    <ol class="breadcrumb justify-content-end" style="margin-bottom: 1.2rem">
        <li class="breadcrumb-item" :class="{ 'active': showHistory}" >
            <a class="cursor-pointer" @click="history">History</a>
        </li>
        <li class="breadcrumb-item " :class="{ 'active': showStatistics}">
            <a class="cursor-pointer" @click="statistics">Statistics</a>
        </li>
    </ol>
</template>

<script>

import {inject, ref} from "vue";
import {useStore} from 'vuex';

export default {
        setup() {
            const emitter = inject("emitter");
            const store = useStore();
            let showStatistics = ref(false)
            let showHistory = ref(true)

            return {
                showStatistics, showHistory,
                statistics: async function () {
                    let statisticsUndefined = Object.keys(store.getters.getMailStatistics).length === 0;
                    if (statisticsUndefined) await store.dispatch('mail/statistics');

                    showStatistics.value = true
                    showHistory.value = false

                    document.getElementById('table').classList.add('p-0')
                    emitter.emit('show-mail-statistics')
                },
                history: function () {
                    showStatistics.value = false
                    showHistory.value = true
                    document.getElementById('table').classList.remove('p-0')
                    emitter.emit('show-mail-history')
                }

            }
        }

    };
</script>
