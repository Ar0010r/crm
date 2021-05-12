<template>
    <div class="d-none" :class="{'d-flex': selectedItems > 0 }">
        <i>with selected: </i>
        <DeleteSpan/>
        <UpdateSpan/>
    </div>
</template>

<script>
    import {ref, inject, watch, onBeforeUnmount} from 'vue';
    import DeleteSpan from './DeleteSelectedSpan'
    import UpdateSpan from './UpdateSelectedSpan'

    export default {
        name: "SelectedEmployeesControl",
        setup() {
            const emitter = inject('emitter');
            let selectedItems = ref(0);

            watch(selectedItems, (nextSelectedItems, prevSelectedItems) => {
                if (nextSelectedItems < 0) selectedItems.value = 0;
            })

            emitter.on('employee-selected', addItem);
            onBeforeUnmount(() => emitter.off('employee-selected', addItem));

            emitter.on('employee-unselected', reduceItem);
            onBeforeUnmount(() => emitter.off('employee-unselected', reduceItem));

            emitter.on('unselect-all-employees', setToZero);
            onBeforeUnmount(() => emitter.off('unselect-all-employees', setToZero));

            function addItem() {
                selectedItems.value++
            }

            function reduceItem() {
                selectedItems.value--
            }

            function setToZero() {
                selectedItems.value = 0;
            }

            return {selectedItems}
        },
        components: {
            DeleteSpan,
            UpdateSpan,
        }
    }
</script>

<style scoped>

</style>