<template>
    <Row>
        <template v-slot:default>
            <td style="text-align: center; vertical-align: middle;">
                <Checkbox :applicant=applicant />
            </td>
            <td class="text-center">
                <p class="m-0">{{ applicant.created_at }}</p>
                <p class="m-0">HR : {{ applicant.hr.login }}</p>
            </td>
            <td v-if="applicant.company">{{ applicant.company.name }}</td>
            <td v-else></td>
            <td>
                <span class="m-0 p-0">{{ applicant.name }}</span>
                <div>
                    <i class="mr-1" v-if="applicant.birthday">{{ applicant.birthday }}</i>
                    <i class="mr-1" v-if="applicant.race">{{ applicant.race }}</i>
                    <strong class="mr-1 m-0 p-0 text-success" v-if="applicant.pickup == 1">P</strong>
                </div>
                <div class="d-flex align-items-center mt-2"
                     v-if="applicant.agreement_exists || applicant.selfie_exists || applicant.scan_exists"
                >
                    <span class="m-0 p-0">Documents :</span>
                    <i class="fas fa-file-contract ml-1 cursor-pointer"
                       data-toggle="modal"
                       data-target="#imageForm"
                       v-if="applicant.agreement_exists"
                       @click="showDocument('agreement')"
                    >

                    </i>
                    <i class="fas fa-id-badge ml-1 cursor-pointer"
                       data-toggle="modal"
                       data-target="#imageForm"
                       v-if="applicant.selfie_exists"
                       @click="showDocument('selfie')"
                    >

                    </i>
                    <i class="fas fa-print ml-1 cursor-pointer"
                       data-toggle="modal"
                       data-target="#imageForm"
                       v-if="applicant.scan_exists"
                       @click="showDocument('scan')"
                    >
                    </i>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <i class="fas fa-envelope d-block d-flex align-items-center" v-if="applicant.email"></i>
                    <p class="m-0 ml-1 p-0">{{ applicant.email }}</p>
                </div>
                <div class="d-flex align-items-center d-flex align-items-center" v-if="applicant.paypal">
                    <i class="fab fa-paypal d-block"></i>
                    <p class="m-0 ml-1 p-0">{{ applicant.paypal }}</p>
                </div>
                <div class="d-flex mt-2 align-items-center" v-if="applicant.phone_1 || applicant.phone_2">
                    <i class="fas fa-phone-volume d-block"></i>
                    <span class="m-0 p-0 ml-1">{{ applicant.phone_1 }}</span>
                    <span class="m-0 p-0 ml-1 pl-1" style="border-left: 1px solid gray">{{ applicant.phone_2 }}</span>
                </div>
            </td>
            <td>
                <span>{{ applicant.address }}</span> <br>
                <span>{{ applicant.city }}</span> <span>{{ ' ' }}</span>
                <span>{{ applicant.state }}</span> <span>{{ ' ' }}</span>
                <span>{{ applicant.zip }}</span> <span>{{ ' ' }}</span>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <StatusSelect v-if="applicant.status"
                              :status='applicant.status'
                              :id='applicant.id'
                              :update-on-select='true'
                />
                <ContactedField :applicant="applicant"/>
            </td>
        </template>
        <template v-slot:actions>
            <EditButton :model="applicant" target="#editApplicantForm" event="edit-applicant-form"/>
            <ContactedButton :applicant="applicant"/>
            <UploadButton :applicant="applicant"/>
            <DeleteButton
                :model="applicant"
                event="delete-applicant-"
                dispatch="applicant/delete"
                :warning='"You want to delete applicant :" + applicant.name '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../../abstract/Table/Row';
import DeleteButton from '../../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../../abstract/Table/Actions/EditButton';
import Checkbox from './RowCheckbox';
import ContactedButton from './ContactedButton';
import UploadButton from './UploadButton';
import StatusSelect from './StatusSelect';
import ContactedField from './ContactedField';
import {inject} from "vue";

export default {
    props: {applicant: Object},
    setup(props) {
        const emitter = inject('emitter');
        return {
            showDocument: function (collection) {
                emitter.emit('show-image-form', {
                    applicant: props.applicant,
                    collection: collection,
                })
            }
        }
    },
    components: {
        Row,
        Checkbox,
        DeleteButton,
        ContactedButton,
        UploadButton,
        EditButton,
        ContactedField,
        StatusSelect
    }
};
</script>