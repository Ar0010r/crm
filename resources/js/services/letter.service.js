export class LetterService {

    constructor(client) {
        this.client = client;
    }

    async get() {
        return await this.client.get('/api/letter');
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
}
