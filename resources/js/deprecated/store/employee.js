import {container} from '../../services';
import {emitter} from '../../app';

export default {
    namespaced: true,
    state: {
        employees: {},
        statistics: {},
        races: {},
       // companies: {},
        statuses: {},
        contacted: [
            {
                "label" : "Contacted",
                "value" : null,
                "disabled": true
            },
        ],
        availableStatuses: {},
        meta: {},
        queryParams: {
            company_id: "",
            status: "",
            page: "",
            hr_id: "",
            contacted_between: "",
            contacted_before: "",
            contacted_after: "",
            contacted: "",
            take: 100
        },

        employeeModel: {
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
            contacted: null,
        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },
        setQueryParams(state, {params}) {
            params.forEach((param) => state.queryParams[param.key] = param.value)
        },
        setEmployeeStatus(state, params) {
            let key = params.id
            state.employees[key].status = params.newStatus
        },
        setRaces(state, races) {
            state.races = races;
        },
        setStatuses(state, statuses) {
            state.statuses = statuses.all;
            state.availableStatuses = statuses.available;
        },

        setData(state, employees) {
            state.employees = employees;
        },

        setStatistics(state, statistics) {
            state.statistics = statistics;
        },

        setMeta(state, meta) {
            state.meta = meta;
        },

        deleteEmployeeById(state, id) {
            delete state.employees[id];
        },

        set(state, employee) {
            let key = employee.id
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
        async get({commit}, params) {
            try {
               /*
                let filters = store.getters[props.getter]
                let queryParams = {};
                Object.keys(filters).map(function (key) {
                    if (filters[key]) {
                        return  queryParams[key] = filters[key];
                    }
                })
                */
                let employees = await container.EmployeeService.get(params);

                commit('setData', employees.data);
                commit('setMeta', employees.meta);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async statistics({commit}, params) {
            try {
                let employees = await container.EmployeeService.getMonthlyStatistics();

                commit('setStatistics', employees.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async getStatuses({commit}) {
            try {
                let statuses = await container.EmployeeService.statuses();
                commit('setStatuses', statuses.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) {
                    container.AuthService.logout()
                }
            }

        },

        async getRaces({commit}) {
            try {
                let races = await container.ApplicantService.races();
                commit('setRaces', races.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        deleteEmployee({commit, dispatch, state}, employee) {
            let key = employee.id;
            if (state.employees[key]) {
                commit('deleteEmployeeById', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        },

        bulkDelete({dispatch}, employees) {
            employees.forEach(employee => dispatch('deleteEmployee', employee))
        },

        bulkUpdate({commit}, employees) {
            employees.forEach(employee => commit('set', employee))
        }
    }
}
