<template>

    <ManagersTable/>
    <EditManagerForm/>
    <StoreManagerForm/>

</template>

<script>
    import ManagersTable from '../components/tables/managers/ManagersTable';
    import StoreManagerForm from '../components/modals/manager/CreateManagerForm';
    import EditManagerForm from '../components/modals/manager/EditManagerForm';


    export default {
        components: {
            ManagersTable,
            StoreManagerForm,
            EditManagerForm,
        }
    };
</script>
