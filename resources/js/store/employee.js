import md5 from "js-md5";
import { container } from '../services/index'
//import {inject} from 'vue';

export default {
    namespaced: true,
    state: {
        employees: {},
        races: {},
        companies: {},
        statuses: {},
        pagination: {},
        queryParams: {
            company_id: "",
            hr_id: "",
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

    actions: {
        async setEmployeesToStore({ commit }, params) {
            let employees = await container.EmployeeService.getEmployees(params);

            commit('setEmployees', employees.employees);
            commit('setPagination', employees.pagination);
        },

        async setStatusesToStore({ commit }) {
            let statuses = await container.EmployeeService.getStatuses();
            commit('setStatuses', statuses.data);
        },

        async setRacesToStore({ commit }) {
            let races = await container.EmployeeService.getRaces();
            commit('setRaces', races.data);
        }
    }
}
