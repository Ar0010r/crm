export class AuthService {

    constructor(client, store)
    {
        this.client = client;
        this.store = store;
    }

    async login(user)
    {
        let response = await this.client.post("/api/login", {login: user.login, password: user.password});

        if (response.data.model.token.plainTextToken) {
            localStorage.setItem('token', response.data.model.token.plainTextToken);

            this.client.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.model.token.plainTextToken;

            this.store.commit('manager/setProfile', response.data.model.user);

            return true;
        }
        return false;
    }

    async logout()
    {
        try {
            await this.client.get("/api/logout");
            localStorage.removeItem('token');
            window.location.href = '/login';
        } catch (e) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        }
    }
}
