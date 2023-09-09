export class AnalyticsService {

    constructor(client) {
        this.client = client;
    }

    async getDaily(params) {
        let response =  await this.client.get('/api/statistics/daily', {params});

        return response.data.model
    }

    async getTotal(params) {
        let response =  await this.client.get('/api/statistics/total', {params});

        return response.data.model
    }

    async getToday(params) {
        let response =  await this.client.get('/api/statistics/today');

        return response.data.model
    }
}
