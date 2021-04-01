import user from './user'
import employee from './employee'
import company from "./company";
import formData from "./formData";
import notification from "./notification";
import {createStore} from 'vuex'
import md5 from "js-md5";

export default createStore({
    getters: {
        getProfile: state => state.user.profile,
        getUsers: state => state.user.users,
        getRoles: state => state.user.roles,
        getHrs: state => state.user.hrs,
        getPersonnels: state => state.user.personnels,

        getUser: state => state.formData.user,
        getEmployee: state => state.formData.employee,
        getCompany: state => state.formData.company,
        isEmployeeDataValid: state => state.formData.employee.isValid,
        getShowNotification: state => state.notification.show,
        getNotificationMessage: state => state.notification.message,

        getRaces: state => state.employee.races,
        getStatuses: state => state.employee.statuses,
        getEmployees: state => state.employee.employees,
        getEmployeesPagination: state => state.employee.pagination,
        getEmployeeQueryParams: state => state.employee.queryParams,
        getEmployeeById: (id, state) => {
            let key = md5(id.toString());
            return state.employee.employees[key]
        },

        getCompanies: state => state.company.companies,
    },
    modules: {
        user: user,
        employee: employee,
        company: company,
        formData: formData,
        notification: notification
    }
})
