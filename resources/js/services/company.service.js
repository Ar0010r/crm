export class CompanyService {

    constructor(client) {
        this.client = client;
    }

    async getCompanies(params) {
        return await this.client.get('/api/companies', {params});
    }

    async storeCompany(company) {
        return await this.client.post('/api/companies', company);
    }

    async updateCompany(company) {
        return await this.client.put('/api/companies/' + company.id, company);
    }

    async deleteCompany(company) {
        return await this.client.delete('/api/companies/' + company.id);
    }

    async getStatistics() {
        return await this.client.get('api/companies/statistics');
    }
}
