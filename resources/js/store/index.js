import user from './user'
import employee from './employee'
import company from "./company";
import {createStore} from 'vuex'
import axios from 'axios';
import md5 from "js-md5";

export default createStore({
    state: {
        /*user: {
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
        statuses: {}*/
    },
    getters: {
        getEmployee: state => state.employee.employee,
        getEmployees: state => state.employee.employees,
        getRaces: state => state.employee.races,
        getHrs: state => {},
        getStatuses: state => state.employee.statuses,
        getCompanies: state => state.company.companies,
        getEmployeeById: (id, state) => {
            let key = md5(id.toString())
            return state.employee.employees[key]
        },
    },
    mutations: {
       /* setEmployee(state, employee) {
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
            state.employees[key].company = employee.company;
        },
        async setRaces(state, races) {
            state.races = races;
        },
        async setStatuses(state, statuses) {
            console.log('from state', statuses)
            state.statuses = statuses;
        },
        async setCompanies(state, companies) {
            state.companies = companies;
        },

        async setEmployees(state, employees) {
            state.employees = employees;
        },*/
    },
    actions: {
        /*async login({}, user) {
            let response = await axios.post("/api/login", {login: user.login, password: user.password});

            if (response.data.plainTextToken) {
                localStorage.setItem('token', response.data.plainTextToken);

                axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.plainTextToken;
                this.state.user.token = response.data.plainTextToken;

                return true;
            }
            return false;
        },*/
    },
    modules: {
        user: user,
        employee: employee,
        company: company,
    }
})
