<template>
    <CompaniesTable/>
    <CreateCompanyForm/>
    <EditCompanyForm/>
</template>

<script>
    import CompaniesTable from '../components/tables/companies/CompaniesTable';
    import CreateCompanyForm from '../components/modals/company/CreateCompanyForm';
    import EditCompanyForm from '../components/modals/company/EditCompanyForm';

    export default {
        components: {
            CompaniesTable,
            CreateCompanyForm,
            EditCompanyForm
        }
    };
</script>
