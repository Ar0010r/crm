import md5 from "js-md5";

//import {useStore} from 'vuex'

export class EmployeeService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async getEmployees(params) {
        let response = await this.client.get('/api/employees', {params});

        let employees = this.setMd5Keys(response.data.data);

        return {employees: employees, pagination: response.data.pagination}
    }

    async search(keyword) {
        let response = await this.client.get('api/search', {
            params: {
                keyword: keyword
            }
        });

        let employees = this.setMd5Keys(response.data.data);

        return {employees: employees, pagination: response.data.pagination}
    }

    async getRaces() {
        return await this.client.get('api/races');
    }

    async sendFile(file) {
        return await this.client.post('api/employees/import', file, {headers: {'Content-Type': 'miltipart/form-data'}});
    }

    async getStatuses() {
        return await this.client.get('api/statuses');
    }

    async setStatusesToStore() {
        let statuses = await this.getStatuses();
        this.store.commit('employee/setStatuses', statuses.data);
    }

    async setRacesToStore() {
        let races = await this.getRaces();
        this.store.commit('employee/setRaces', races.data);
    }

    async setEmployeesToStore(params) {
        let employees = await this.getEmployees(params);
        this.store.commit('employee/setEmployees', employees.employees);
        this.store.commit('employee/setPagination', employees.pagination);
    }

    setMd5Keys(employeesList){
        let employees = {};
        Object.keys(employeesList).map(function (key) {
            let index = md5(employeesList[key].id.toString());
            employees[index] = employeesList[key];
        });

        return employees;
    }

}
