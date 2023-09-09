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

    async conversion(params) {
        if (params == undefined) params = {"take": 2};
        let response = await this.client.get('api/company/statistics', {params});
        return {data: response.data.list, meta: response.data.meta}
    }

    controlled(companies, profile) {
        if (profile.role == "admin") {
            return companies
        }

        let filtered = []

        Object.values(companies).forEach((company) => {
            if (company.manager_id == profile.id) {
                filtered.push(company)
            }
        })

        return filtered
    }

    hr(companies) {
        let hr = []

        Object.values(companies).forEach((company) => {
            if (company.type == 1) {
                hr.push(company)
            }
        })

        return hr
    }

    delivery(companies) {
        let delivery = []

        Object.values(companies).forEach((company) => {
            if (company.type == 0) {
                delivery.push(company)
            }
        })

        return delivery
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
