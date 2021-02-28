import user from './user'
import employee from './employee'
import company from "./company";
import formData from "./formData";
import {createStore} from 'vuex'
import md5 from "js-md5";

export default createStore({
    getters: {
        getUsers: state => state.user.users,
        getHrs: state => state.user.hrs,
        getPersonnels: state => state.user.personnels,
        getEmployee: state => state.formData.employee,
        getEmployeeQueryParams: state => state.employee.queryParams,
        getEmployees: state => state.employee.employees,
        getEmployeesPagination: state => state.employee.pagination,
        getRaces: state => state.employee.races,
        getStatuses: state => state.employee.statuses,
        getCompanies: state => state.company.companies,
        isEmployeeDataValid: state => state.formData.employee.isValid,
        getEmployeeById: (id, state) => {
            let key = md5(id.toString());
            return state.employee.employees[key]
        },
    },
    modules: {
        user: user,
        employee: employee,
        company: company,
        formData: formData
    }
})
