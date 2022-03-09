export class TestService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        let response =  await this.client.get('/api/test', {params});
        let data = this.setIdKeys(response.data.list);
        return {data: data, meta: response.data.meta}
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

    setIdKeys(data) {
        let refactored = {};
        Object.keys(data).map(function (key) {
            let index = data[key].id
            refactored[index] = data[key];
        });

        return refactored;
    }
}
