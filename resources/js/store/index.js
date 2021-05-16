import user from './user'
import employee from './employee'
import company from "./company";
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
        getEmployeesPagination: state => state.employee.pagination,
        getEmployeeQueryParams: state => state.employee.queryParams,
        getEmployeeById: (id, state) => {
            return state.employee.employees[id]
        },

        getCompanies: state => state.company.companies,
        getEmptyCompany: state => state.company.emptyCompany,
    },
    modules: {
        user: user,
        employee: employee,
        company: company,
    }
})
