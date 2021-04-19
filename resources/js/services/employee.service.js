import md5 from "js-md5";

export class EmployeeService {

    constructor(client) {
        this.client = client;
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
        return await this.client.post('api/employees/import', file, {headers: {'Content-Type': 'multipart/form-data'}});
    }

    async getStatuses() {
        return await this.client.get('api/statuses');
    }

    setMd5Keys(employeesList){
        let employees = {};
        Object.keys(employeesList).map(function (key) {
            let index = md5(employeesList[key].id.toString());
            employees[index] = employeesList[key];
        });

        return employees;
    }

    async deleteEmployee(employee){
        return await this.client.delete('api/employees/'+employee.id);
    }

}
