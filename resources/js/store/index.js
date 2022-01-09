import user from './user'
import employee from './employee'
import company from "./company";
import letter from "./letter";
import test from "./test";
import {createStore} from 'vuex'

export default createStore({
    getters: {
        getProfile: state => state.user.profile,
        getUsers: state => state.user.users,
        getEmptyUser: state => state.user.emptyUser,
        getRoles: state => state.user.roles,
        getHrs: state => state.user.hrs,
        getPersonnels: state => state.user.personnels,

        getShowNotification: state => state.notification.show,
        getNotificationMessage: state => state.notification.message,

        getRaces: state => state.employee.races,
        getStatuses: state => state.employee.statuses,
        getAvailableStatuses: state => state.employee.availableStatuses,
        getEmptyEmployee: state => state.employee.emptyEmployee,
        getEmployees: state => state.employee.employees,
        getMonthlyStatistics: state => state.employee.statistics,
        getEmployeesPagination: state => state.employee.pagination,
        getEmployeeQueryParams: state => state.employee.queryParams,
        getEmployeeById: (id, state) => {
            return state.employee.employees[id]
        },

        getCompanies: state => state.company.companies,
        getCompanyQueryParams: state => state.company.queryParams,
        getStatistics: state => state.company.statistics,
        getEmptyCompany: state => state.company.emptyCompany,

        getLetters: state => state.letter.letters,
        getLetterQueryParams: state => state.letter.queryParams,
        getLetterStatistics: state => state.letter.statistics,
        getEmptyLetter: state => state.letter.emptyLetter,

        getTests: state => state.test.tests,
        getTestQueryParams: state => state.test.queryParams,
        getTestStatistics: state => state.test.statistics,
        getEmptyTest: state => state.test.emptyTest,
        getEnvs: state => state.test.envs,
        getTemplates: state => state.test.templates,
    },
    modules: {
        user: user,
        employee: employee,
        company: company,
        letter: letter,
        test: test
    }
})
