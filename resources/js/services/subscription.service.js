export class SubscriptionService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        if(params) {
            params.order_by = "next_payment"
            params.asc = true
        } else {
            params = {
                'order_by' : 'next_payment',
                'asc' : true
            }
        }
        let response =  await this.client.get('/api/subscription', {params});
        let data = this.setIdKeys(response.data.list);
        return {data: data, meta: response.data.meta}
    }

    async store(subscription) {
        return await this.client.post('/api/subscription', subscription);
    }

    async update(subscription) {
        return await this.client.put('/api/subscription/' + subscription.id, subscription);
    }

    async delete(subscription) {
        return await this.client.delete('/api/subscription/' + subscription.id);
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
