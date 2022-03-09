import {container} from "./index";
import {emitter} from "../app";

export class ApplicantService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        let response =  await this.client.get('/api/employee', {params});
        let data = this.setIdKeys(response.data.list);
        return {data: data, meta: response.data.meta}
    }

    async store(applicant) {
        return await this.client.post('/api/employee', applicant);
    }

    async update(applicant) {
        return await this.client.put('/api/employee/' + applicant.id, applicant);
    }

    async delete(applicant) {
        return await this.client.delete('/api/employee/' + applicant.id);
    }

    async races() {
        return await this.client.get('api/races');
    }

    async import(file) {
        return await this.client.post('api/employees/import', file, {headers: {'Content-Type': 'multipart/form-data'}});
    }

    async upload(request) {
        return await this.client.post('api/employees/upload', request, {headers: {'Content-Type': 'multipart/form-data'}});
    }

    async statuses() {
        return await this.client.get('api/statuses');
    }

    async bulkDelete(employees) {
        return await this.client.patch('api/employees', {'employees': employees});
    }

    async bulkUpdate(employees, status) {
        return await this.client.put('api/employees', {employees: employees, status: status});
    }

    async getMedia(id, collection) {
        let params = {id: id, collection: collection};
        return await this.client.get('api/employee/media', {params});
    }

    async deleteMedia(media) {
        return await this.client.delete('api/employee/media/' + media.id);
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
