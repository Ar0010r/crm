<template>
    <label class="custom-control custom-checkbox p-0 m-0 d-flex justify-content-center">
        <input type="checkbox" class="custom-control-input" style="justify-self: center"
               v-model="selected"
               true-value=1
               false-value=0
        >
        <span class="custom-control-label"/>
    </label>
</template>

<script>
    import {ref, inject, watch, onBeforeUnmount} from 'vue';

    export default {
        name: "RowCheckbox",
        props: {employee: Object},
        setup(props) {
            let selected = ref(0);
            const emitter = inject('emitter');

            watch(selected, (nextSelected, prevSelected) => {
                if (nextSelected == 1) emitter.emit('employee-selected');
                else emitter.emit('employee-unselected');
            })

            function emitEmployee() {
                if (selected.value == 1) emitter.emit('add-selected-employee', props.employee);
            }

            function select() {
                selected.value = 1;
            }

            function unSelect() {
                selected.value = 0;
            }

            emitter.on('select-all-employees', select);
            emitter.on('unselect-all-employees', unSelect);
            emitter.on('collect-selected-employees', emitEmployee);

            onBeforeUnmount(() => {
                emitter.off('select-all-employees', select);
                emitter.off('unselect-all-employees', unSelect);
                emitter.off('collect-selected-employees', emitEmployee);
            });

            return {selected}
        }
    }
</script>

<style scoped>
    .custom-control-label::before {
        position: relative;
    }
</style>