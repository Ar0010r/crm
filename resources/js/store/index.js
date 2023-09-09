import applicant from './applicant'
import company from "./company";
import mail from "./mail";
import test from "./test";
import manager from "./manager";
import subscription from "./subscription";
import profile from "./profile";
import conversion from "./conversion";
import analytics from "./analytics";
import {createStore} from 'vuex'

export default createStore({
    getters: {
        getProfileModel: state => state.profile.model,
        getProfile: state => state.profile.profile,

        //getProfile: state => state.manager.profile,
        getManagers: state => state.manager.data,
        getManagerModel: state => state.manager.managerModel,
        getManagerMeta: state => state.manager.meta,
        getManagerQueryParams: state => state.manager.queryParams,
        getRoles: state => state.manager.roles,
        getHrs: state => state.manager.hrs,
        getPersonnels: state => state.manager.personnels,

        getShowNotification: state => state.notification.show,
        getNotificationMessage: state => state.notification.message,

        getRaces: state => state.applicant.races,
        getStatuses: state => state.applicant.statuses,
        getContactedStatuses: state => state.applicant.contacted,
        getAvailableStatuses: state => state.applicant.availableStatuses,
        getApplicantModel: state => state.applicant.applicantModel,
        getApplicants: state => state.applicant.data,
        getMonthlyStatistics: state => state.applicant.statistics,
        getApplicantsMeta: state => state.applicant.meta,
        getApplicantQueryParams: state => state.applicant.queryParams,
        /*getApplicant: (id, state) => {
            return state.applicant.data[id]
        },*/

        getCompanies: state => state.company.data,
        getCompaniesMeta: state => state.company.meta,
        getCompanyQueryParams: state => state.company.queryParams,
        getCompanyModel: state => state.company.companyModel,
        getTypes: state => state.company.types,
        getCompanyStatuses: state => state.company.statuses,
        getCompanyScam: state => state.company.scam,

        getMails: state => state.mail.data,
        getMailsMeta: state => state.mail.meta,
        getMailQueryParams: state => state.mail.queryParams,
        getMailStatistics: state => state.mail.statistics,
        getMailModel: state => state.mail.mailModel,

        getTests: state => state.test.data,
        getTestsMeta: state => state.test.meta,
        getTestQueryParams: state => state.test.queryParams,
        getTestModel: state => state.test.testModel,
        getEnvs: state => state.test.envs,
        getTemplates: state => state.test.templates,

        getSubscriptions: state => state.subscription.data,
        getSubscriptionsMeta: state => state.subscription.meta,
        getSubscriptionQueryParams: state => state.subscription.queryParams,
        getSubscriptionModel: state => state.subscription.subscriptionModel,
        getProviders: state => state.subscription.providers,
        getServices: state => state.subscription.services,
        getPeriods: state => state.subscription.periods,
        getSubscriptionStatuses: state => state.subscription.statuses,

        getConversion: function (state) {
            return state.conversion.data;
        },
        //getConversion: state => state.conversion.data,
        getConversionMeta: state => state.conversion.meta,
        getConversionQueryParams: state => state.conversion.queryParams,

        getDailyAnalytics: function (state) {
            return state.analytics.data.daily;
        },

        getTotalAnalytics: function (state) {
            return state.analytics.data.total;
        },

        getTodayAnalytics: function (state) {
            return state.analytics.data.today;
        },

        getHrAnalytics: function (state) {
            return state.analytics.data.hr;
        },
        //getTotalAnalytics: state => state.analytics.data,
        getDailyAnalyticsQueryParams: function (state) {
            return {
                daily_from: state.analytics.queryParams.daily_from,
                daily_to: state.analytics.queryParams.daily_to,
                daily_hrs: state.analytics.queryParams.daily_hrs
            };
        },

        getTotalAnalyticsQueryParams: function (state) {
            return {
                total_from: state.analytics.queryParams.total_from,
                total_to: state.analytics.queryParams.total_to
            };
        },
    },
    modules: {
        profile: profile,
        applicant: applicant,
        company: company,
        test: test,
        manager: manager,
        mail: mail,
        subscription: subscription,
        conversion: conversion,
        analytics: analytics,
    }
})
