import md5 from "js-md5";
import {container} from '../services/index';
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        employees: {},
        races: {},
        companies: {},
        statuses: {},
        pagination: {},

        emptyEmployee: {
            address: null,
            birthday: null,
            city: null,
            company_id: null,
            company: {name: null},
            hr: {login: null},
            email: null,
            name: null,
            paypal: null,
            phone_1: null,
            phone_2: null,
            race: null,
            state: null,
            zip: null,
            pickup: null,
        }
    },
    mutations: {
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
        async setEmployeesToStore({commit}, params) {
            try {
                let employees = await container.EmployeeService.getEmployees(params);

                commit('setEmployees', employees.employees);
                commit('setPagination', employees.pagination);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async setStatusesToStore({commit}) {
            try {
                let statuses = await container.EmployeeService.getStatuses();
                commit('setStatuses', statuses.data);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }

        },

        async setRacesToStore({commit}) {
            try {
                let races = await container.EmployeeService.getRaces();
                commit('setRaces', races.data);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        deleteEmployee({commit, dispatch, state}, employee) {
            let key = md5(employee.id.toString());
            if (state.employees[key]) {
                commit('deleteEmployeeById', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        bulkDelete({dispatch}, employees){
            employees.forEach(employee => dispatch('deleteEmployee', employee))
        }
    }
}
