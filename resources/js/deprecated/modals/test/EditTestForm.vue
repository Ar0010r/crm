<template>
    <div class="modal fade" id="editTestForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <TestFormFields ref="testFields" :test="test"/>
                </div>
                <div class="modal-footer">
                    <button id="editTestFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button @click.prevent="updateTest" type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import TestFormFields from './TestFormFields';
    import {useStore} from 'vuex';
    import {computed, inject, reactive, ref, onBeforeUnmount} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const testFields = ref(null);
            let users = computed(() => store.getters.getManagers);
            let profile = computed(() => store.getters.getProfile);
            const testModel = {...store.getters.getTestModel};

            let test = reactive({...testModel});

            emitter.on('edit-test-form', setTest);
            onBeforeUnmount(() => emitter.off('edit-test-form', setTest));

            async function updateTest() {
                try {
                    await testFields.value.validate();
                    let updatedTest = await container.TestService.update(test);

                    store.commit('test/set', updatedTest.data.model);
                    emitter.emit('notification-success', 'test was updated');
                    document.getElementById('editTestFormClose').click()
                } catch (e) {
                    console.log(e);
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }

            function setTest(testData) {
                Object.keys(testData).forEach(key => test[key] = testData[key])
            }

            return {test, testFields, updateTest}
        },
        components: {
            TestFormFields
        }
    };
</script>

