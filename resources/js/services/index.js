import axios from 'axios'

import store from '../store'
import { EmployeeService } from "./employee.service";
import { CompanyService } from "./company.service";
import { AuthService } from "./auth.service";
import { UserService } from "./user.service";
import { LetterService } from "./letter.service";

//axios.defaults.baseURL = '/api/';
const serviceProviders = {
    AuthService: () => new AuthService(axios, store),
    EmployeeService: () => new EmployeeService(axios),
    CompanyService: () => new CompanyService(axios),
    UserService: () => new UserService(axios),
    LetterService: () => new LetterService(axios),
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
