export class UserService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
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

    async setRolesToStore() {
        let response = await this.getRoles();
        this.store.commit('user/setRoles', response.data);
    }

    async storeUser(user) {
        return this.client.post('api/users', user);
    }

    async updateUser(user) {
        if (user.file) {
            return await this.client.put('api/users/' + user.id, user, {headers: {'Content-Type': 'multipart/form-data'}});
        }
        return await this.client.put('api/users/' + user.id, user);
    }

    async setProfileToStore() {
        let response = await this.getProfile();
        this.store.commit('user/setProfile', response.data);
    }

    async setUsersToStore(params) {
        let response = await this.getUsers(params);

        let usersList = response.data;

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


        this.store.commit('user/setUsers', users);
        this.store.commit('user/setHrs', hrs);
        this.store.commit('user/setPersonnels', personnels);

    }
}
