export class UserService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async getUsers() {
        return await this.client.get('/api/users');
    }

    async setUsersToStore(params) {
        let response = await this.getUsers(params);

        let usersList = response.data;

        let hrs = {};
        Object.keys(usersList).map(function (key) {
            let index = usersList[key].id;
            if(usersList[key].role === 'hr') hrs[index] = usersList[key];
        });

        let personnels = {};
        Object.keys(usersList).map(function (key) {
            let index = usersList[key].id;
            if(usersList[key].role === 'personnel') personnels[index] = usersList[key];
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
