import {createStore} from 'vuex'
import axios from 'axios';
import md5 from "js-md5";

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
        getCompanies: state => state.companies,
        getEmployeeById: (id, state) => {
            console.log('what', state.employees);
            let key = md5(id.toString())
            return state.employees[key]
        },
    },
    mutations: {
        setEmployee(state, employee) {
            state.employee = employee
        },
        setEmployeeStatus(state, params)
        {
            let key = md5(params.id.toString())
            state.employees[key].status = params.newStatus
        },
        setEmployeeById(state, employee) {
            console.log('before set in store', employee)
            let key = md5(employee.id.toString());
            state.employees[key] = {...state.employees[key], ...employee};
            //state.employees[key] = {...state.employees[employee.id], ...employee};
            state.employees[key].company = employee.company;
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
            let data = response.data;
            let companies = {};
            Object.keys(data).map(function (key) {
                let index = data[key].id;
                companies[index] = data[key];
            });
            state.companies = companies;
        },

        async setEmployees(state) {
            let response = await axios.get('api/employees');
            let data = response.data;
            let employees = {};
            Object.keys(data).map(function (key) {
                let index = md5( data[key].id.toString() );
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
