import applicant from './applicant'
import company from "./company";
import mail from "./mail";
import test from "./test";
import manager from "./manager";
import {createStore} from 'vuex'

export default createStore({
    getters: {
        getProfile: state => state.manager.profile,
        getManagers: state => state.manager.data,
        getManagerModel: state => state.manager.managerModel,
        getManagerMeta: state => state.manager.meta,
        getManagerQueryParams: state => state.manager.queryParams,
        getRoles: state => state.manager.roles,
        getHrs: state => state.manager.hrs,
        getPersonnels: state => state.manager.personnels,

        getShowNotification: state => state.notification.show,
        getNotificationMessage: state => state.notification.message,

        getRaces: state => state.applicant.races,
        getStatuses: state => state.applicant.statuses,
        getContactedStatuses: state => state.applicant.contacted,
        getAvailableStatuses: state => state.applicant.availableStatuses,
        getApplicantModel: state => state.applicant.applicantModel,
        getApplicants: state => state.applicant.data,
        getMonthlyStatistics: state => state.applicant.statistics,
        getApplicantsMeta: state => state.applicant.meta,
        getApplicantQueryParams: state => state.applicant.queryParams,
        /*getApplicant: (id, state) => {
            return state.applicant.data[id]
        },*/

        getCompanies: state => state.company.data,
        getCompaniesMeta: state => state.company.meta,
        getCompanyQueryParams: state => state.company.queryParams,
        getStatistics: state => state.company.statistics,
        getCompanyModel: state => state.company.companyModel,
        getTypes: state => state.company.types,

        getMails: state => state.mail.data,
        getMailsMeta: state => state.mail.meta,
        getMailQueryParams: state => state.mail.queryParams,
        getMailStatistics: state => state.mail.statistics,
        getMailModel: state => state.mail.mailModel,

        getTests: state => state.test.data,
        getTestsMeta: state => state.test.meta,
        getTestQueryParams: state => state.test.queryParams,
        getTestModel: state => state.test.testModel,
        getEnvs: state => state.test.envs,
        getTemplates: state => state.test.templates,
    },
    modules: {
        applicant: applicant,
        company: company,
        test: test,
        manager: manager,
        mail: mail
    }
})
