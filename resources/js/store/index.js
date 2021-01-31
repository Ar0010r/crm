import {createStore} from 'vuex'
import axios from 'axios';

export default createStore({
    state: {
        user: {
            id: "",
            login: "",
            token: ""
        },
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
        getEmployee: state => state.employee,
        getEmployees: state => state.employees,
        getRaces: state => state.races,
        getStatuses: state => state.statuses,
        getCompanies: state => state.companies
    },
    mutations: {
        setEmployee(state, employee) {
            state.employee = employee
        },
        setEmployeeStatus(state, params) {
            state.employees[params.id].status = params.newStatus
        },
        async setRaces(state) {
            let response = await axios.get('api/races');
            state.races = response.data;
        },
        async setStatuses(state) {
            let response = await axios.get('api/statuses');
            state.statuses = response.data;
        },
        async setCompanies(state) {
            let response = await axios.get('api/companies');
            state.companies = response.data;
        },

        async setEmployees(state) {
            let response = await axios.get('api/employees');
            let data = response.data;
            let employees = {};
            Object.keys(data).map(function (key) {
                let index = data[key].id;
                employees[index] = data[key];
            });
            state.employees = employees;
        },
        async removeEmployees(state) {
            state.employees = {};
        }
    },
    actions: {
        async login({}, user) {
            let response = await axios.post("/api/login", {login: user.login, password: user.password});

            if (response.data.plainTextToken) {
                localStorage.setItem('token', response.data.plainTextToken);

                axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.plainTextToken;
                this.state.user.token = response.data.plainTextToken;

                return true;
            }
            return false;
        },
    },
    modules: {}
})
