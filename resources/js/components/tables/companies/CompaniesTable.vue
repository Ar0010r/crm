<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Companies
        </h4>
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary btn" data-toggle="modal" data-target="#addCompanyForm">Add
                company
            </button>
        </div>
        <div class="table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <CompaniesTableHead/>
                <tbody>
                <CompaniesTableRow/>
                <CompaniesTableRow/>
                <CompaniesTableRow/>
                <CompaniesTableRow/>
                <CompaniesTableRow/>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import CompaniesTableHead from './CompaniesTableHead.vue';
    import CompaniesTableRow from './CompaniesTableRow.vue';
    import CreateCompanyForm from '../../modals/company/CreateCompanyForm';
    import EditCompanyForm from '../../modals/company/EditCompanyForm';

    export default {
        components: {
            CompaniesTableHead,
            CompaniesTableRow,
            CreateCompanyForm,
            EditCompanyForm
        }
    };
</script>
