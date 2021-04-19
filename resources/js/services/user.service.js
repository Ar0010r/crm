
export class UserService {

    constructor(client) {
        this.client = client;
    }

    async getUsers() {
        return await this.client.get('/api/users');
    }

    async getProfile() {
        return await this.client.get('/api/profile');
    }

    async getRoles() {
        return await this.client.get('/api/available-roles');
    }

    async storeUser(user) {
        return this.client.post('api/users', user);
    }

    async updateUser(user) {

        if (user instanceof FormData) {
            console.log('file');
            return await this.client.post('api/users/' + user.get('id'), user, {headers: {'Content-Type': 'multipart/form-data'}});
        }

        return await this.client.put('api/users/' + id, user);
    }
}