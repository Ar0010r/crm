<template>
    <Row>
        <template v-slot:default>
            <td>{{company.created_at}}</td>
            <td>{{company.manager.login}}</td>
            <td>{{company.name}}</td>
            <td>{{type(company.type)}}</td>
            <td>
                <a :href="company.domain">{{company.domain}}</a>
            </td>
            <td>{{company.email}}</td>
            <td>{{company.pseudonym}}</td>
        </template>
        <template v-slot:actions>
            <EditButton :model="company" target="#editCompanyForm" event="edit-company-form"/>
            <DeleteButton
                :model="company"
                event="delete-company-"
                dispatch="company/delete"
                :warning='"You want to delete company:" + company.name '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';

export default {
    props: {company: Object},
    setup() {
        return{
            type: function (type) {
                if(type == 0) {
                    return 'Delivery'
                }

                if(type == 1) {
                    return 'Hiring'
                }
            }
        }
    },
    components: {
        Row,
        DeleteButton,
        EditButton
    }
};
</script>
