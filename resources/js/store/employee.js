import md5 from "js-md5";
import {container} from '../services/index'

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
        },

        emptyEmployee: {
            address: "",
            birthday: "",
            city: "",
            company_id: "",
            company: {name: ""},
            hr: {login: ""},
            email: "",
            name: "",
            paypal: "",
            phone_1: "",
            phone_2: "",
            race: "",
            state: "",
            zip:"",
            pickup: "",
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

        deleteEmployeeById(state, id) {
            delete state.employees[id];
        },

        setEmployeeById(state, employee) {
            let key = md5(employee.id.toString());
            if (state.employees[key]) {
                state.employees[key] = {...state.employees[key], ...employee};
                state.employees[key].company = employee.company;

            } else {
                let newEmpObj = {};
                newEmpObj[key] = employee;
                state.employees = {...newEmpObj, ...state.employees};
            }
        },
    },

    actions: {
        async setEmployeesToStore({commit, dispatch}, params) {
            try {
                let employees = await container.EmployeeService.getEmployees(params);

                commit('setEmployees', employees.employees);
                commit('setPagination', employees.pagination);
            } catch (e) {
                dispatch('notification/activate', e.response.data, {root: true});
            }
        },

        async setStatusesToStore({commit, dispatch}) {
            try{
                let statuses = await container.EmployeeService.getStatuses();
                commit('setStatuses', statuses.data);
            } catch (e) {
                dispatch('notification/activate', e.response.data, {root: true});
            }

        },

        async setRacesToStore({commit, dispatch}) {
           try {
               let races = await container.EmployeeService.getRaces();
               commit('setRaces', races.data);
           } catch (e) {
               dispatch('notification/activate', e.response.data, {root: true});
           }
        },

        deleteEmployee({commit, dispatch, state}, employee) {
            let key = md5(employee.id.toString());
            if (state.employees[key]) {
                commit('deleteEmployeeById', key);
            } else {
                dispatch('notification/activate', e.response.data, {root: true});
            }
        },
    }
}
