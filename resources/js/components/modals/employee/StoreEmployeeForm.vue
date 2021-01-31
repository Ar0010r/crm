<template>
    <div class="modal fade" id="storeEmployeeForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add employee
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">We advice to use standard address format with 9-digit zip-code
                            </small>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body pb-0">
                    <EmployeeFormFields :employee='emptyEmployee'></EmployeeFormFields>
                    <EmployeePickUpField></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import EmployeeFormFields from './fields/EmployeeFormFields'
    import EmployeePickUpField from './fields/EmployeePickUpField'
    import {computed} from 'vue';

    export default {
        setup() {
            let emptyEmployee = {
                name: "",
                email: "",
                paypal: "",
                company: "",
                address: "",
                city: "",
                state: "",
                zip: "",
                phone_1: "",
                phone_2: "",
                birthday: "",
                race: "",
                status: "",
                pickup: "",
            };

            return {emptyEmployee}
        },
        components: {
            EmployeeFormFields,
            EmployeePickUpField
        }
    };
</script>
