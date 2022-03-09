import axios from 'axios'

import store from '../store'
import { ApplicantService } from "./applicant.service";
import { CompanyService } from "./company.service";
import { AuthService } from "./auth.service";
import { ManagerService } from "./manager.service";
import { MailService } from "./mail.service";
import { TestService } from "./test.service";

//axios.defaults.baseURL = '/api/';
const serviceProviders = {
    AuthService: () => new AuthService(axios, store),
    ApplicantService: () => new ApplicantService(axios),
    CompanyService: () => new CompanyService(axios),
    ManagerService: () => new ManagerService(axios),
    MailService: () => new MailService(axios),
    TestService: () => new TestService(axios),
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
