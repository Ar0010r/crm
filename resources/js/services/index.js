
import axios from 'axios'
import { EmployeeService } from "./employee.service";

axios.defaults.baseURL = '/api/';

const serviceProviders = {
    EmployeeService: function () {
        return new EmployeeService(axios);
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
