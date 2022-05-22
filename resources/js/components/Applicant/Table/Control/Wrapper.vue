<template>
    <Main v-if="selectedItems === 0" />
    <Secondary v-else />
</template>

<script>
    import Main from './MainControl'
    import Secondary from './SecondaryControl'
    import {ref, inject, watch, onBeforeUnmount} from 'vue';
    export default {
        setup() {
            const emitter = inject('emitter');
            let selectedItems = ref(0);

            watch(selectedItems, (nextSelectedItems, prevSelectedItems) => {
                if (nextSelectedItems < 0) selectedItems.value = 0;
            })

            emitter.on('applicant-selected', increment);
            emitter.on('applicant-unselected', decrement);
            emitter.on('unselect-all-applicants', reset);

            function increment() {
                selectedItems.value++
            }

            function decrement() {
                selectedItems.value--
            }

            function reset() {
                selectedItems.value = 0;
            }

            onBeforeUnmount(() => {
                emitter.off('applicant-unselected', decrement)
                emitter.off('unselect-all-applicants', reset)
                emitter.off('applicant-selected', increment)
            });

            return {selectedItems}
        },
        components: {
            Main, Secondary
        }
    }
</script>
