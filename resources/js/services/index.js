
import axios from 'axios'
import { useStore } from 'vuex'
import { EmployeeService } from "./employee.service";
import { CompanyService } from "./company.service";
import { AuthService } from "./auth.service";

//axios.defaults.baseURL = '/api/';

const serviceProviders = {
    AuthService: function () {
        return new AuthService(axios, useStore());
    },
    EmployeeService: function () {
        return new EmployeeService(axios, useStore());
    },
    CompanyService: function () {
        return new CompanyService(axios, useStore());
    }

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
