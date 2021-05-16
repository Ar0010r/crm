<template>
    <label class="custom-control custom-checkbox p-0 m-0 d-flex justify-content-center">
        <input class="custom-control-input" type="checkbox" style="justify-self: center"
               true-value=1
               false-value=0
               v-model="selectAll"
               >
        <span class="custom-control-label"/>
    </label>
</template>

<script>
    import {ref, inject, watch, computed, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';

    export default {
        name: "HeadCheckbox",
        setup() {
            let selectAll = ref(0);
            let selectedItems = ref(0);
            const emitter = inject('emitter');
            const store = useStore();

            let employees = computed(() => store.getters.getEmployees);

            watch(selectAll, (nextSelectAll, prevSelectAll) => {
                if (nextSelectAll == 1) {
                    selectedItems.value = Object.keys(employees.value).length;
                    emitter.emit('select-all-employees')
                } else {
                    if(selectedItems.value == Object.keys(employees.value).length){
                        disable()
                    }
                }
            });

            watch(selectedItems, (nextSelectedItems, prevSelectedItems) => {
                if (nextSelectedItems < Object.keys(employees.value).length) selectAll.value = 0
            });

            emitter.on('employee-unselected', reduceItem);
            onBeforeUnmount(() => emitter.off('employee-unselected', reduceItem));

            emitter.on('reset-checkbox', disable);
            onBeforeUnmount(() => emitter.off('reset-checkbox', disable));

            function reduceItem() {
                if (selectAll.value == 1) {
                    selectedItems.value--
                }
            }

            function disable() {
                selectedItems.value = 0;
                emitter.emit('unselect-all-employees')
            }

            return {
                selectAll,selectedItems
            }
        }
    }
</script>

<style scoped>
    .custom-control-label::before {
        position: relative;
    }
</style>