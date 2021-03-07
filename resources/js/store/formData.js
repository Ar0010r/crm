export default {
    namespaced: true,
    state: {
        employee: {
            name: "",
            email: "",
            paypal: "",
            company: {
                name: ""

            },
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
            isValid: ""
        },
        user: {
            id: "",
            login: "",
            created_at: "",
            role: "",
            dataIsValid: "",
        },

        company: {
            id: "",
            name: "",
            personnel_id: "",
            personnel: {login: ""},
            domain: "",
            email: "",
            created_at: "",
            dataIsValid: "",
        },
    },
    mutations: {
        setEmployee(state, employee) {
            state.employee = employee
        },
        setUser(state, user) {
            state.user = user
        },
        setCompany(state, company) {
            console.log('in store', company);
            state.company = company
        },
        setEmployeeIsValidState(state, status) {
            state.employee.dataIsValid = status
        },
        setUserIsValidState(state, status) {
            state.user.dataIsValid = status
        },
        setCompanyIsValidState(state, status) {
            state.company.dataIsValid = status
        },
    }
}
