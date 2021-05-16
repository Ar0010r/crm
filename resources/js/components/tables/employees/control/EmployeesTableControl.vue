<template>
    <Main v-if="selectedItems === 0"/>
    <Secondary v-else />
</template>

<script>
    import Main from './EmployeesTableMainControl'
    import Secondary from './EmployeesTableSecondaryControl'
    import {ref, inject, watch, onBeforeUnmount} from 'vue';
    export default {
        name: "EmployeesTableControl",
        setup() {
            const emitter = inject('emitter');
            let selectedItems = ref(0);

            watch(selectedItems, (nextSelectedItems, prevSelectedItems) => {
                if (nextSelectedItems < 0) selectedItems.value = 0;
            })

            emitter.on('employee-selected', increment);
            emitter.on('employee-unselected', decrement);
            emitter.on('unselect-all-employees', reset);

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
                emitter.off('employee-unselected', decrement)
                emitter.off('unselect-all-employees', reset)
                emitter.off('employee-selected', increment)
            });

            return {selectedItems}
        },
        components: {
            Main, Secondary
        }
    }
</script>
