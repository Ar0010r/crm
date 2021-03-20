<template>
    <div class="modal fade" id="fileInputForm">
        <div class="modal-dialog">
            <form class="modal-content" enctype='multipart/form-data'>
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add employees
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">Example format of accepted <a href="public/example.xls" download>file</a>
                            </small>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="card-body">
                    <div class="flow-drop py-5 px-3 d-flex align-items-center justify-content-center"
                         ondragenter="$(this).addClass('flow-dragover')"
                         ondragend="$(this).removeClass('flow-dragover')"
                         ondrop="$(this).removeClass('flow-dragover')"
                         style="display: block;">
                        <div class="d-flex flex-column justify-content-center">
                            <h4>Drop files here to upload or select</h4>
                            <button @click="selectFile" type="button" class="flow-browse btn btn-secondary">Select from
                                your computer
                                <input @change="setFile" type="file" id="empFileInput" accept=".xlsx, .xls"
                                       style="visibility: hidden; position: absolute; width: 1px; height: 1px;">
                            </button>
                        </div>
                    </div>

                    <ul v-if="success" class="flow-list list-group mt-4">
                        <li class="flow-file list-group-item flow-file">
                            <div class="flow-progress media">
                                <div class="media-body">
                                    <div><strong class="flow-file-name text-success">File exported successfully</strong>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul v-if="errors" class="flow-list list-group mt-4">
                        <li class="flow-file list-group-item flow-file">
                            <div v-for="error in errors" class="flow-progress media">
                                <div class="media-body">
                                    <div><strong class="flow-file-name text-danger">{{error.shift()}}</strong></div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul v-if="file" class="flow-list list-group mt-4">
                        <li class="flow-file list-group-item flow-file-49077-ASeleznovCVpdf">
                            <div class="flow-progress media">
                                <div class="media-body">
                                    <div><strong class="flow-file-name">{{file.name}}</strong> - <em
                                            class="flow-file-progress">file is uploaded, press play to send it</em>
                                    </div>
                                    <div>
                                        <small class="flow-file-size text-muted">{{(file.size/1000000).toFixed(2)}} Mb
                                        </small>
                                    </div>
                                </div>
                                <div class="ml-3 align-self-center">
                                    <button type="button" @click="sendFile"
                                            class="flow-file-resume btn btn-sm icon-btn btn-outline-success"
                                    ><i class="ion ion-md-play"></i></button>
                                    <button type="button" @click="deleteFile"
                                            class="flow-file-cancel btn btn-sm icon-btn btn-outline-danger ml-1"><i
                                            class="ion ion-md-close"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {computed, ref, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {

            const container = inject('container');
            const store = useStore();

            let file = ref(null);
            let errors = ref(null);
            let success = ref(false);

            function setFile(event) {
                console.log(event);
                file.value = event.target.files[0];
            }

            function deleteFile() {
                file.value = null;
                errors.value = null;
                document.getElementById("empFileInput").value = null;
            }

            async function sendFile() {
                let formData = new FormData();
                formData.set('file', file.value);

                try {
                   await container.EmployeeService.sendFile(formData);
                } catch (e) {
                    success.value = false;
                    if (e.response.status === 422) {
                        errors.value = e.response.data.errors;
                    }
                    return ;
                }

                success.value = true;

                let data = await container.EmployeeService.getEmployees();

                store.commit('employee/setEmployees', data.employees);
                store.commit('employee/setPagination', data.pagination);
            }

            return {
                setFile,
                deleteFile,
                sendFile,
                file: computed(() => file.value),
                errors: computed(() => errors.value),
                success: computed(() => success.value),
                selectFile: () => document.getElementById("empFileInput").click()
            }
        }
    };
</script>
