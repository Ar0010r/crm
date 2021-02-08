export class AuthService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async login(user) {
        let response = await this.client.post("/api/login", {login: user.login, password: user.password});

        if (response.data.plainTextToken) {
            localStorage.setItem('token', response.data.plainTextToken);

            this.client.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.plainTextToken;
            //this.store.user.token = response.data.plainTextToken;

            return true;
        }
        return false;
    }
}
