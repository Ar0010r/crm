export class EmployeeService {

    constructor(client) {
        this.client = client;
    }

    async getEmployees(params) {

        return await axios.$get('/api/employees', { params });

    }

}
