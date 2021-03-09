export class AuthService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async login(user) {
        let response = await this.client.post("/api/login", {login: user.login, password: user.password});

        if (response.data.token.plainTextToken) {
            localStorage.setItem('token', response.data.token.plainTextToken);

            this.client.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token.plainTextToken;

            this.store.commit('user/setProfile', response.data.user);

            return true;
        }
        return false;
    }
}
