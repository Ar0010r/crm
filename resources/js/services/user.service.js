
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
            return await this.client.post('api/users/' + user.get('id'), user, {headers: {'Content-Type': 'multipart/form-data'}});
        }

        return await this.client.put('api/users/' + user.id, user);
    }

    async deleteUser(user) {
        return await this.client.delete('api/users/' + user.id);
    }

    sort(usersList){
        let hrs = {};

        Object.keys(usersList).map(function (key) {
            let index = usersList[key].id;
            if (usersList[key].role === 'hr' || usersList[key].role === 'top hr') hrs[index] = usersList[key];
        });

        let personnels = {};
        Object.keys(usersList).map(function (key) {
            let index = usersList[key].id;
            if (usersList[key].role === 'personnel') personnels[index] = usersList[key];
        });

        let users = {};
        Object.keys(usersList).map(function (key) {
            let index = usersList[key].id;
            users[index] = usersList[key];
        });

        return {
            hrs: hrs,
            personnels: personnels,
            users: users,
        }
    }
}