<template>
    <div class="modal fade" id="createTestForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add test
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <TestFormFields ref="testFields" :test="test"/>
                </div>
                <div class="modal-footer">
                    <button id="storeTestFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button  type="button" class="btn btn-primary" @click="storeTest(test)">Add
                    </button>
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
            const container = inject('container');
            const emitter = inject("emitter");
            const testFields = ref(null);
            const profile = computed(() => store.getters.getProfile)
            const managers = computed(() => store.getters.getManagers)

            let testModel = {...store.getters.getTestModel};

            console.log('testModel', testModel)

            if(profile.value.role === 'personnel' || profile.value.role === 'hr'){
                testModel.manager_id = profile.id
            }

            if(profile.value.role === 'personnel'){
                testModel.type = 0
            }

            if(profile.value.role === 'hr'){
                testModel.type = 1
            }

            let test = reactive({...testModel});

            async function storeTest(test) {
                try {
                    await testFields.value.validate();
                    let response = await container.TestService.store(test);
                    let storedTest = response.data.model;

                    console.log('storedTest', storedTest);

                    store.commit('test/set', storedTest);
                    document.getElementById('storeTestFormClose').click();
                    emitter.emit('notification-success', 'test was created');
                    resetForm()
                } catch (e) {
                    console.log(e);
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }

            }

            function resetForm() {
                Object.keys(testModel).forEach(key => test[key] = testModel[key]);

                test.manager_id = profile.value.id;
                test.manager = profile.value;
                console.log(test.manager.login)
            }

            emitter.on('create-test-form', resetForm);
            onBeforeUnmount(() => emitter.off('create-test-form', resetForm));

            return {
                storeTest,
                test,
                testFields
            }
        },
        components: {
            TestFormFields
        }
    };
</script>

