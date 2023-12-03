import {container} from '../services/index'
import {emitter} from '../app';
import * as moment from 'moment';

export default {
    namespaced: true,
    state: {
        data: {},
        meta: {from: 0, to: 0, total: 0},
        races: [],
        statuses: {},
        availableStatuses: {},
        queryParams: {
            company_id: null,
            hr_company_id: null,
            status: null,
            hr_id: null,
            contacted_between: null,
            contacted_before: null,
            contacted_after: null,
            created_before: null,
            created_after: null,
            contacted: null,
            take: 100,
            page: 1,
        },
        applicantModel: {
            address: null,
            birthday: null,
            city: null,
            company_id: null,
            hr_company_id: null,
            hrCompany: {name: null},
            company: {name: null},
            hr: {login: null},
            email: null,
            name: null,
            paypal: null,
            phone_1: null,
            phone_2: null,
            race: null,
            state: null,
            zip: null,
            pickup: null,
            contacted: null,
            hired_at: null,
            address_2: null,
            secondary_email: null,

        }
    },
    mutations: {
        setQueryParam(state, {key, value}) {
            state.queryParams[key] = value
        },

        setData(state, applicants) {
            state.data = applicants;
        },

        setMeta(state, meta) {
            state.meta = meta;
        },

        setRaces(state, races) {
            state.races = races;
        },

        updateStatus(state, params) {
            let key = params.id
            state.data[key].status = params.status
        },
        setStatuses(state, statuses) {
            state.statuses = statuses.all;
            state.availableStatuses = statuses.available;
        },

        set(state, applicant) {
            let key = applicant.id;
            if (state.data[key]) {
                state.data[key] = {...state.data[key], ...applicant};

            } else {
                let newApplicantObj = {};
                newApplicantObj[key] = applicant;
                state.data = {...newApplicantObj, ...state.data};
                state.meta.total = state.meta.total + 1
            }
        },
        unset(state, id) {
            if (state.data[id]) {
                delete state.data[id];
            }
        },
    },
    actions: {
        async get({commit, dispatch}, params) {
            try {
                let response = await container.ApplicantService.get(params);
                commit('setData', response.data);
                commit('setMeta', response.meta);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        async getRaces({commit}) {
            try {
                let races = await container.ApplicantService.races();
                commit('setRaces', races.data.list);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async getStatuses({commit}) {
            try {
                let statuses = await container.ApplicantService.statuses();
                commit('setStatuses', statuses.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) {
                    container.AuthService.logout()
                }
            }
        },

        async create({commit, dispatch}, model) {
            try {
                moment.locale('en-ca');
                let date = moment().format('L');

                moment.locale('fr');
                let time = moment().format('LTS');

                model.contacted = date + " " + time;
                let response = await container.ApplicantService.store(model);
                commit('set', response.data.model);
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        },

        async update({commit, dispatch}, model) {
            try {
                moment.locale('en-ca');
                let date = moment().format('L');

                moment.locale('fr');
                let time = moment().format('LTS');

                model.contacted = date + " " + time;

                let response = await container.ApplicantService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async updateStatus({commit, dispatch}, model) {
            try {
              /*  await container.ApplicantService.update(model);
                commit('updateStatus', model);*/
                let response = await container.ApplicantService.update(model);
                commit('set', response.data.model);
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async delete({commit, dispatch, state}, applicant) {
            let id = applicant.id;
            if (state.data[id]) {
                await container.ApplicantService.delete(applicant)
                commit('unset', id);
            }
        },

        async bulkDelete({commit}, applicants) {
            try {
                await container.ApplicantService.bulkDelete(applicants);
                applicants.forEach(applicant => commit('unset', applicant.id))
            } catch (e) {
                console.log(e)
                emitter.emit('notification-error', e.response.data)
            }
        },

        async bulkUpdate({commit}, {applicants, status}) {
            try {
                moment.locale('en-ca');
                let date = moment().format('L');

                moment.locale('fr');
                let time = moment().format('LTS');

                let contacted = date + " " + time;

                applicants.forEach(applicant => applicant.contacted = contacted)

                await container.ApplicantService.bulkUpdate(applicants, status, contacted);
                if (status) applicants.forEach(applicant => applicant.status = status);

                applicants.forEach(applicant => commit('set', applicant))
            } catch (e) {
                emitter.emit('notification-error', e.response.data)
            }
        }
    },
}
