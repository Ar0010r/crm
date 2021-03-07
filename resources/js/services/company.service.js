export class CompanyService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async getCompanies() {
        return await this.client.get('/api/companies');
    }

    async storeCompany(company) {
        return await this.client.post('/api/companies', company);
    }

    async updateCompany(company) {
        console.log('sent to server', company);
        return await this.client.put('/api/companies/' + company.id, company);
    }

    async setCompaniesToStore(){
        let companiesList = await this.getCompanies();
        companiesList = companiesList.data;

        let companies = {};
        Object.keys(companiesList).map(function (key) {
            let index = companiesList[key].id;
            companies[index] = companiesList[key];
        });
        this.store.commit('company/setCompanies', companies);
    }
}
