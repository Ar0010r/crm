<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Tests
        </h4>
        <div class="d-flex mb-3 mt-2" style="width: 60%">
            <button class="btn btn-secondary" type="button" title="Refresh">
                <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
            </button>
            <button class="btn btn-primary btn ml-2" data-toggle="modal"
                    data-target="#addTestForm">Add test
            </button>
            <select class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Manager</option>
                <option value="0">Delivery</option>
                <option value="1">Hiring</option>
            </select>
            <select class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Company</option>
                <option value="0">Delivery</option>
                <option value="1">Hiring</option>
            </select>
            <select class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Env</option>
                <option value="0">Delivery</option>
                <option value="1">Hiring</option>
            </select>
            <select class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Template</option>
                <option value="0">Delivery</option>
                <option value="1">Hiring</option>
            </select>
        </div>
        <div class="">
            <h3>CDN Recruitment</h3>
            <h5>Manger: Pavel </h5>
            <div>
                <table class="datatables-demo table table-striped table-bordered col-6">
                    <thead>
                    <tr>
                        <th class="text-left font-weight-bold">Date</th>
                        <th class="text-left font-weight-bold">Env</th>
                        <th class="text-left font-weight-bold">Template</th>
                        <th class="text-left font-weight-bold">Google</th>
                        <th class="text-left font-weight-bold">Outlook</th>
                        <th class="text-left font-weight-bold">Yahoo</th>
                        <th class="text-left font-weight-bold">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd gradeX">
                        <td>01.01.2022</td>
                        <td>The bat</td>
                        <td>Hello</td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                        data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                        title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>01.05.2022</td>
                        <td>Web</td>
                        <td>Welcome letter</td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                            data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                            title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>01.05.2022</td>
                        <td>The Bat</td>
                        <td>Welcome letter</td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                            data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                            title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="">
            <h3>MSN Recruitment</h3>
            <h5>Manger: Alexander </h5>
            <div>
                <table class="datatables-demo table table-striped table-bordered col-6">
                    <thead>
                    <tr>
                        <th class="text-left font-weight-bold">Date</th>
                        <th class="text-left font-weight-bold">Env</th>
                        <th class="text-left font-weight-bold">Template</th>
                        <th class="text-left font-weight-bold">Google</th>
                        <th class="text-left font-weight-bold">Outlook</th>
                        <th class="text-left font-weight-bold">Yahoo</th>
                        <th class="text-left font-weight-bold">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd gradeX">
                        <td>01.01.2022</td>
                        <td>The bat</td>
                        <td>Hello</td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                            data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                            title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>01.05.2022</td>
                        <td>Web</td>
                        <td>Hello</td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                            data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                            title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>01.05.2022</td>
                        <td>The Bat</td>
                        <td>Welcome letter</td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td><span class="badge badge-outline-danger">Spam</span></td>
                        <td><span class="badge badge-outline-success">Inbox</span></td>
                        <td>
                            <div class="d-flex  justify-content-between align-items-center ">
                                <a data-toggle="modal" data-target="#editLetterForm">
                                    <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                                            data-toggle="tooltip" data-target="#editLetterForm" data-placement="right"
                                            title="Edit">
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#deleteForm" type="button"
                                   class="ion ion-md-trash danger">
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTestForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add test
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Company </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select company --</option>
                                <option> ABC Recruitment</option>
                                <option> Whatever company</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Env </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select env --</option>
                                <option> Web</option>
                                <option> The Bat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Template </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select template --</option>
                                <option> Welcome letter</option>
                                <option> Hello</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Google </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select status --</option>
                                <option> Inbox</option>
                                <option> Spam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Outlook </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select status --</option>
                                <option> Inbox</option>
                                <option> Spam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <label class="form-label col-md-2">Yahoo </label>
                            <select class="custom-select form-control form-control-sm col-md-10">
                                <option disabled selected :value="null"> -- select status --</option>
                                <option> Inbox</option>
                                <option> Spam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="storeCompanyFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button  type="button" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import LettersBundleTable from '../components/tables/letters/LettersTableBundle';
import StoreLetterForm from '../components/modals/letter/CreateLetterForm.vue';
import EditLetterForm from '../components/modals/letter/EditLetterForm.vue';
import {useStore} from 'vuex';

export default {
    setup() {

    },
    components: {
        LettersBundleTable,
        StoreLetterForm,
        EditLetterForm,
    }
};
</script>
<style>
img {
    max-width: 100%;
}
</style>
