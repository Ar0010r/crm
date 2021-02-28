import md5 from "js-md5";
import container from "../services/employee.service.js";
//import {inject} from 'vue';

export default {
    namespaced: true,
    state: {
        /*employee: {
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
        },*/

        employees: {},
        races: {},
        companies: {},
        statuses: {},
        pagination: {},
        queryParams: {
            company: "",
            status: "",
            page: "",
            recordsPerPage: ""
        }
    },
    mutations: {
         setQueryParam(state, {key, value}) {
             state.queryParams[key] = value
         },
        setEmployeeStatus(state, params) {
            let key = md5(params.id.toString())
            state.employees[key].status = params.newStatus
        },
        setRaces(state, races) {
            state.races = races;
        },
        setStatuses(state, statuses) {
            state.statuses = statuses;
        },

        setEmployees(state, employees) {
            state.employees = employees;
        },

        setPagination(state, pagination) {
            state.pagination = pagination;
        },

        setEmployeeById(state, employee) {
            let key = md5(employee.id.toString());
            if (state.employees[key]) {
                state.employees[key] = {...state.employees[key], ...employee};
                state.employees[key].company = employee.company;
                //state.employees[key].pickup = employee.pickup;

            } else {
                let newEmpObj = {};
                newEmpObj[key] = employee;
                //newEmpObj[key] = {...state.employee, ...employee};
                state.employees = {...newEmpObj, ...state.employees};
            }
        },
    },
}
