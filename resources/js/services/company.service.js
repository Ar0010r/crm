export class CompanyService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        let response = await this.client.get('/api/company', {params});
        let data = this.setIdKeys(response.data.list);
        return {data: data, meta: response.data.meta}
    }

    async store(company) {
        return await this.client.post('/api/company', company);
    }

    async update(company) {
        return await this.client.put('/api/company/' + company.id, company);
    }

    async delete(company) {
        return await this.client.delete('/api/company/' + company.id);
    }

    async statistics() {
        return await this.client.get('api/company/statistics');
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
