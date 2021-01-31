<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Managers
        </h4>
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary btn" data-toggle="modal" data-target="#addManagerForm">
                Add manager
            </button>
        </div>
        <div class="table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <ManagersTableHead/>
                <tbody>
                <ManagersTableRow/>
                <ManagersTableRow/>
                <ManagersTableRow/>
                </tbody>
            </table>
        </div>
    </div>

    <!--<EditManagerForm/>
    <StoreManagerForm/>-->

</template>

<script>
    import Pagination from '../../layout/Pagination.vue';
    import StoreManagerForm from '../../modals/manager/CreateManagerForm';
    import EditManagerForm from '../../modals/manager/EditManagerForm';
    import ManagersTableHead from './ManagersTableHead';
    import ManagersTableRow from './ManagersTableRow';

    export default {
        mounted() {
            console.log("Component mounted.");
        },

        components: {
            Pagination,
            StoreManagerForm,
            EditManagerForm,
            ManagersTableHead,
            ManagersTableRow
        }
    };
</script>
