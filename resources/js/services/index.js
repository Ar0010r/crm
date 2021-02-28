
import axios from 'axios'
import { useStore } from 'vuex'
import { EmployeeService } from "./employee.service";
import { CompanyService } from "./company.service";
import { AuthService } from "./auth.service";
import { UserService } from "./user.service";

//axios.defaults.baseURL = '/api/';

const serviceProviders = {
    AuthService: () => new AuthService(axios, useStore()),
    EmployeeService: () => new EmployeeService(axios, useStore()),
    CompanyService: () => new CompanyService(axios, useStore()),
    UserService: () => new UserService(axios, useStore()),


};

export const container = (new Proxy(serviceProviders, {
    get(target, name, receiver) {
        if (Reflect.has(target, name)) {
            const definition = Reflect.get(target, name, receiver)
            return typeof definition === 'function'
                ? definition({container: this})
                : definition
        }

        return undefined
    }
}));
