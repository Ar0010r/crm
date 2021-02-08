import md5 from "js-md5";

export class EmployeeService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async getEmployees(params) {
        return await this.client.get('/api/employees', { params });
    }

    async getRaces() {
        return await this.client.get('api/races');
    }

    async getStatuses() {
        return await this.client.get('api/statuses');
    }

    async setStatusesToStore(){
        let statuses = await this.getStatuses();
        this.store.commit('employee/setStatuses', statuses.data);
    }

    async setRacesToStore(){
        let races = await this.getRaces();
        this.store.commit('employee/setRaces', races.data);
    }

    async setEmployeesToStore() {
        let response = await this.getEmployees();
        let employeesList = response.data;

        let employees = {};
        Object.keys(employeesList).map(function (key) {
            let index = md5( employeesList[key].id.toString() );
            employees[index] = employeesList[key];
        });

        this.store.commit('employee/setEmployees', employees);
    }
}
