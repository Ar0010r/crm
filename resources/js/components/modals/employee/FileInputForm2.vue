<template>
    <div class="modal fade" id="fileInputForm">
        <div class="modal-dialog">
            <form class="modal-content" enctype='multipart/form-data'>
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add employees
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">.xls file requirements
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
                            <button type="button" class="flow-browse btn btn-secondary">Select from your computer
                                <input type="file" multiple="multiple"
                                       style="visibility: hidden; position: absolute; width: 1px; height: 1px;">
                            </button>
                        </div>
                    </div>

                    <div class="flow-progress media d-none mt-4">
                        <div class="mr-3">
                            <button type="button" onclick="r.upload(); return(false);"
                                    class="progress-resume-link btn icon-btn btn-primary">
                                <i class="ion ion-md-play"></i>
                            </button>
                            <button type="button" onclick="r.pause(); return(false);"
                                    class="progress-pause-link btn icon-btn btn-warning">
                                <i class="ion ion-md-pause"></i>
                            </button>
                            <button type="button" onclick="r.cancel(); return(false);"
                                    class="progress-cancel-link btn icon-btn btn-danger">
                                <i class="ion ion-md-close"></i>
                            </button>
                        </div>
                        <div class="media-body align-self-center">
                            <div class="progress-container progress">
                                <div class="progress-bar"></div>
                            </div>
                        </div>
                    </div>

                    <ul class="flow-list list-group d-none mt-4"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<style lang="scss">
html,
body,
#app {
    width: 100%;
    height: 100%;
    font-family: Arial, Helvetica, sans-serif;
    background: #e3e4e5;
}

.flex {
    display: flex;
    height: 100%;
    width: 100%;

    &--column {
        flex-direction: column;
    }

    &--align-center {
        align-items: center;
    }

    &--justify-center {
        justify-content: center;
    }
}

.logos {
    padding-top: 16px;
    display: grid;
    grid-template-columns: auto auto;
    grid-gap: 32px;
}

.title {
    display: grid;
    grid-template-columns: auto auto auto;
    grid-gap: 16px;
    padding: 32px;

    .laravel {
        color: #ff291a
    }

    .vue {
        color: #41b883;
    }

    .plus {
        color: #35495e
    }

}
</style>
