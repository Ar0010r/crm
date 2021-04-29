export class CompanyService {

    constructor(client) {
        this.client = client;
    }

    async getCompanies() {
        return await this.client.get('/api/companies');
    }

    async storeCompany(company) {
        return await this.client.post('/api/companies', company);
    }

    async updateCompany(company) {
        return await this.client.put('/api/companies/' + company.id, company);
    }
}
