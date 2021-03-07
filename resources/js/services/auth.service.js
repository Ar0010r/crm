export class AuthService {

    constructor(client, store) {
        this.client = client;
        this.store = store;
    }

    async login(user) {
        let response = await this.client.post("/api/login", {login: user.login, password: user.password});

        //console.log(response.data.token.plainTextToken);
        if (response.data.token.plainTextToken) {
            localStorage.setItem('token', response.data.token.plainTextToken);

            this.client.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token.plainTextToken;


            //this.store.user.token = response.data.plainTextToken;

            return true;
        }
        return false;
    }
}
