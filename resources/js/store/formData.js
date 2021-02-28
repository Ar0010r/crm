
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
            isValid: ""
        },
    },
    mutations: {
        setEmployee(state, employee) {
            state.employee = employee
        },
        setEmployeeIsValidState(state, status) {
            state.employee.dataIsValid = status
        },
    }
}
