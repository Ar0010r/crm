<template>
    <tr class="odd gradeX">
        <td>{{company.created_at}}</td>
        <td>{{company.personnel.login}}</td>
        <td>{{company.name}}</td>
        <td>{{company.domain}}</td>
        <td>{{company.email}}</td>
        <td>
            <a data-toggle="modal" data-target="#editCompanyForm">
                <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                        data-toggle="tooltip" data-target="#editCompanyForm"
                        data-placement="right" title="Edit"
                        @click="putCompanyInfoToStore(company)"
                >

                </button>
            </a>
        </td>
    </tr>
</template>

<script>
    import{useStore} from 'vuex';
    export default {
        setup(){
            const store = useStore();

            function putCompanyInfoToStore(company) {
                let object = {
                    id: company.id,
                    name: company.name,
                    personnel_id: company.personnel_id,
                    personnel: company.personnel,
                    domain: company.domain,
                    email: company.email,
                    created_at: company.created_at,
                    dataIsValid: true,
                };

                store.commit('formData/setCompany', object);
            }

            return { putCompanyInfoToStore }
        },
        props: {company: Object},
    };
</script>
