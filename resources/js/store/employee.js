import md5 from "js-md5";

export default {
    namespaced: true,
    state: {
        employee: {
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
        },

        employees: {},
        races: {},
        companies: {},
        statuses: {}
    },
    getters: {
       /* getEmployee: state => state.employee,
        getEmployees: state => state.employees,
        getRaces: state => state.races,
        getStatuses: state => state.statuses,
        getEmployeeById: (id, state) => {
            let key = md5(id.toString())
            return state.employees[key]
        },*/
    },
    mutations: {
        setEmployee(state, employee) {
            state.employee = employee
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
    },
    modules: {}
}
