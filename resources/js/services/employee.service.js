
export class EmployeeService {

    constructor(client) {
        this.client = client;
    }

    async store(employee) {
        return await this.client.post('api/employees', employee)
    }

    async get(params) {
        let response = await this.client.get('/api/employees', {params});
        let data = this.setIdKeys(response.data.list);

        return {data: data, meta: response.data.meta}
    }

    async races() {
        return await this.client.get('api/races');
    }

    async sendFile(file) {
        return await this.client.post('api/employees/import', file, {headers: {'Content-Type': 'multipart/form-data'}});
    }

    async statuses() {
        return await this.client.get('api/statuses');
    }

    async delete(employee) {
        return await this.client.delete('api/employees/' + employee.id);
    }

    async bulkDelete(employees) {
        return await this.client.patch('api/employees', {'employees': employees});
    }

    async update(employee) {
        return await this.client.put('api/employees/' + employee.id, employee);
    }

    async bulkUpdate(employees, status) {
        return await this.client.put('api/employees', {employees: employees, status: status});
    }

    async getMonthlyStatistics() {
        return await this.client.get('api/employees/statistics');
    }

    setIdKeys(data) {
        let refactored = {};
        Object.keys(data).map(function (key) {
            let index = data[key].id
            refactored[index] = data[key];
        });

        return refactored;
    }

}
