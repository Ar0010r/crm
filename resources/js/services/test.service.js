export class TestService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        return await this.client.get('/api/test', {params});
    }

    async store(test) {
        return await this.client.post('/api/test', test);
    }

    async update(test) {
        return await this.client.put('/api/test/' + test.id, test);
    }

    async delete(test) {
        return await this.client.delete('/api/test/' + test.id);
    }
}
