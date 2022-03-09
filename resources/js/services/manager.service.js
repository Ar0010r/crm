export class ManagerService {

    constructor(client) {
        this.client = client;
    }

    async get(params) {
        let response =  await this.client.get('/api/users', {params});
        let data = this.setIdKeys(response.data.list);

        return {data: data, meta: response.data.meta}
    }

    async profile() {
        return await this.client.get('/api/profile');
    }

    async roles() {
        return await this.client.get('/api/available-roles');
    }

    async store(user) {
        return this.client.post('api/users', user);
    }

    async update(user) {
        if (user instanceof FormData) {
            return await this.client.post('api/users/' + user.get('id'), user, {headers: {'Content-Type': 'multipart/form-data'}});
        }

        return await this.client.put('api/users/' + user.id, user);
    }

    async delete(user) {
        return await this.client.delete('api/users/' + user.id);
    }

    sort(list){
        let hrs = {};
        Object.keys(list).map(function (key) {
            let index = list[key].id;
            if (list[key].role === 'hr' || list[key].role === 'top hr') hrs[index] = list[key];
        });

        let personnels = {};
        Object.keys(list).map(function (key) {
            let index = list[key].id;
            if (list[key].role === 'personnel') personnels[index] = list[key];
        });

        let managers = {};
        Object.keys(list).map(function (key) {
            let index = list[key].id;
            managers[index] = list[key];
        });

        return {
            hrs: hrs,
            personnels: personnels,
            managers: managers,
        }
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
