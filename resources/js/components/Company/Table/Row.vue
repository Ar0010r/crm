<template>
    <Row>
        <template v-slot:default>
            <td>{{ company.created_at }}</td>
            <td v-if="profileIsAdmin">{{ company.manager.login }}</td>
            <td>{{ company.name }}</td>
            <td>{{ type(company.type) }}</td>
            <td>
                <p class="m-0">{{ company.email }}</p>
                <a class="m-0" :href="company.domain">{{ company.domain }}</a>
            </td>
            <td>{{ company.pseudonym }}</td>
            <td class="text-center">
                <span class="badge text-center"
                      :class="company.scam === 'ok' ? 'badge-outline-success' : 'badge-outline-danger'">
                {{ company.scam }}
                </span>
            </td>
            <td class="text-center">
                <span class="badge text-center"
                      :class="company.status === 'in use' ? 'badge-outline-success' : 'badge-outline-danger'">
                {{ company.status }}
                </span>
            </td>
        </template>
        <template v-slot:actions>
            <EditButton
                :disabled="disabled"
                :model="company" target="#editCompanyForm" event="edit-company-form"
            />
            <DeleteButton
                :disabled="disabled"
                :model="company"
                event="delete-company-"
                dispatch="company/delete"
                :warning='"You want to delete company:" + company.name + " with all applicants" '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    props: {company: Object},
    setup(props) {
        const store = useStore();

        return {
            type: function (type) {
                if (type == 0) {
                    return 'Delivery'
                }

                if (type == 1) {
                    return 'Hiring'
                }
            },
            disabled: computed(() => {
                let profile = store.getters.getProfile;
                if (profile.role == 'admin') {
                    return false
                }

                if (props.company.manager_id == profile.id) {
                    return false
                }
                return true
            }),
            profileIsAdmin: computed(() => {
                let profile = store.getters.getProfile
                return profile.role == 'admin' || profile.role == 'top hr'
            })
        }
    },
    components: {
        Row,
        DeleteButton,
        EditButton
    }
};
</script>
