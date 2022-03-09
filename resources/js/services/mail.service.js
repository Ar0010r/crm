export class MailService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        let response =  await this.client.get('/api/letter', {params});
        let data = this.setIdKeys(response.data.list);
        return {data: data, meta: response.data.meta}
    }

    async store(letter) {
        return await this.client.post('/api/letter', letter);
    }

    async update(letter) {
        return await this.client.put('/api/letter/' + letter.id, letter);
    }

    async delete(letter) {
        return await this.client.delete('/api/letter/' + letter.id);
    }

    async statistics() {
        return await this.client.get('api/letter/statistics');
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
