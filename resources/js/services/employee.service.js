
export class EmployeeService {

    constructor(client) {
        this.client = client;
    }

    async store(employee) {
        return await this.client.post('api/employees', employee)
    }

    async getEmployees(params) {
        let response = await this.client.get('/api/employees', {params});
        let employees = this.setIdKeys(response.data.list);
        console.log('response.data', response.data)

        return {employees: employees, pagination: response.data.meta}
    }

    async search(keyword) {
        let response = await this.client.get('api/search', {
            params: {
                keyword: keyword
            }
        });

        let employees = this.setIdKeys(response.data.list);

        return {employees: employees, pagination: response.data.meta}
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

    setIdKeys(employeesList) {
        let employees = {};
        Object.keys(employeesList).map(function (key) {
            let index = employeesList[key].id
            employees[index] = employeesList[key];
        });

        return employees;
    }

    async deleteEmployee(employee) {
        return await this.client.delete('api/employees/' + employee.id);
    }

    async deleteSelected(employees) {
        return await this.client.patch('api/employees', {'employees': employees});
    }

    async update(employee) {
        return await this.client.put('api/employees/' + employee.id, employee);
    }

    async updateSelected(employees, status) {
        return await this.client.put('api/employees', {employees: employees, status: status});
    }

}
