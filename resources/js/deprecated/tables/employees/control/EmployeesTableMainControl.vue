<template>
    <div class="d-flex justify-content-between align-items-center" style="min-width: 100%">
        <div class="d-flex justify-content-start mb-3" style="width: 80%">
            <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
                <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
            </button>
            <button v-if="profile.role !== 'personnel'" type="button" data-toggle="modal"
                    data-target="#storeEmployeeForm"
                    class=" ml-2 p-0 btn-primary btn col-sm-2 text-nowrap text-center"
                    @click.prevent="showCreateEmployeeForm"
            >Add applicant
            </button>
            <button v-if="profile.role !== 'personnel'" type="button" data-toggle="modal" data-target="#fileInputForm"
                    class=" p-0 btn-primary btn  ml-2 col-sm-2 text-nowrap"
                    @click="showFileUploadForm">File upload
            </button>
            <select v-model="activeFilters.company_id" class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Company</option>
                <option v-for="company in companies" :value="company.id">
                    {{ company.name }}
                </option>
            </select>
            <select v-if="profile.role === 'admin' || profile.role === 'top hr'"
                    v-model="activeFilters.hr_id" class="custom-select form-control ml-2 col-sm-2">
                <option value="" selected>Hr</option>
                <option v-for="hr in hrs" :value="hr.id">
                    {{ hr.login }}
                </option>
            </select>
            <select v-model="contacted"
                    @change="handleContacted(contacted)"
                    class="custom-select custom-select form-control-lg  ml-2 col-sm-2">
                <option value="" selected>Contacted</option>
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="2 days +">2 days +</option>
            </select>
            <select v-model="activeFilters.status"
                    class="custom-select custom-select form-control-lg  ml-2 col-sm-2">
                <option value="" selected>Status</option>
                <option v-for="(key, value) in statuses" :value="value">{{ value }}</option>
            </select>
            <select v-model="activeFilters.take" class="custom-select ml-2 col-sm-2">
                <option value="100" selected>100</option>
                <option v-for="record in take" :value="record">
                    {{ record }}
                </option>
            </select>
        </div>
    </div>
</template>
<script>
    import Datepicker from './Datepicker';
    import {useStore} from 'vuex';
    import moment from 'moment';
    import {computed, watch, inject} from 'vue';

    export default {
        components: { Datepicker },
        setup() {
            let store = useStore();
            const emitter = inject("emitter");
            let activeFilters = computed(() => store.getters.getEmployeeQueryParams);

            async function filter() {
                store.commit('employee/setQueryParam', {'key': 'company_id', 'value': activeFilters.value.company_id});
                store.commit('employee/setQueryParam', {'key': 'status', 'value': activeFilters.value.status});
                store.commit('employee/setQueryParam', {'key': 'take', 'value': activeFilters.value.take});
                store.commit('employee/setQueryParam', {
                    'key': 'contacted_between',
                    'value': activeFilters.value.contacted_between
                });
                store.commit('employee/setQueryParam', {
                    'key': 'contacted_after',
                    'value': activeFilters.value.contacted_after
                });
                store.commit('employee/setQueryParam', {
                    'key': 'contacted_before',
                    'value': activeFilters.value.contacted_before
                });
                store.commit('employee/setQueryParam', {'key': 'hr_id', 'value': activeFilters.value.hr_id});

                await getApplicants();
            }

            async function getApplicants() {
                let filters = {};

                ["page", "hr_id", "company_id", "status", "contacted_between", "contacted_before", "contacted_after", "take"].map(function (key) {
                    if (activeFilters.value[key]) {
                        filters[key] = activeFilters.value[key];
                    }
                });

                /*if (Object.keys(filters).length == 1 && Object.keys(filters).shift() == 'take') {
                    return
                }*/

                await store.dispatch('applicant/get', filters);
            }

            watch(() => activeFilters, (first, second) => filter(), {deep: true});

            const setToday = () => {
                moment.locale('en-ca');
                let tenAgoDate = moment().subtract(10, 'hours').format('L');

                moment.locale('fr');
                let tenAgoTime = moment().subtract(10, 'hours').format('LTS');
                console.log({
                    'key': 'contacted_after',
                    'value': tenAgoDate + " " + tenAgoTime
                })
               /* store.commit('employee/setQueryParam', {
                    'key': 'contacted_after',
                    'value': tenAgoDate + " " + tenAgoTime
                });*/

                store.commit('employee/setQueryParams', {
                    'params': [
                        {
                            'key': 'contacted_after',
                            'value': tenAgoDate + " " + tenAgoTime
                        },
                        {
                            'key': 'contacted_before',
                            'value': ""
                        },
                        {
                            'key': 'contacted_between',
                            'value': ""
                        },
                        {
                            'key': 'status',
                            'value': "Need data"
                        }
                    ]
                });
            };
            const setYesterday = () => {
                moment.locale('en-ca');
                let tenAgoDate = moment().subtract(10, 'hours').format('L');
                let twentyForAgoDate = moment().subtract(24, 'hours').format('L');

                moment.locale('fr');
                let tenAgoTime = moment().subtract(10, 'hours').format('LTS');
                let twentyForAgoTime = moment().subtract(24, 'hours').format('LTS');

                store.commit('employee/setQueryParams', {
                    'params': [
                        {
                            'key': 'contacted_after',
                            'value': ""
                        },
                        {
                            'key': 'status',
                            'value': "Need data"
                        },
                        {
                            'key': 'contacted_before',
                            'value': ""
                        },
                        {
                            'key': 'contacted_between',
                            'value': twentyForAgoDate + " " + twentyForAgoTime + "," + tenAgoDate + " " + tenAgoTime
                        }
                    ]
                });
            };
            const setTwoDays = () => {
                moment.locale('en-ca');
                let fortyEightAgoDate = moment().subtract(48, 'hours').format('L');

                moment.locale('fr');
                let fortyEightAgoTime = moment().subtract(48, 'hours').format('LTS');

                /*store.commit('employee/setQueryParam', {
                    'key': 'contacted_after',
                    'value': fortyEightAgoDate + " " + fortyEightAgoTime
                });*/

                store.commit('employee/setQueryParams', {
                    'params': [
                        {
                            'key': 'contacted_before',
                            'value': fortyEightAgoDate + " " + fortyEightAgoTime
                        },
                        {
                            'key': 'contacted_after',
                            'value': ""
                        },
                        {
                            'key': 'contacted_between',
                            'value': ""
                        },
                        {
                            'key': 'status',
                            'value': "Need data"
                        }
                    ]
                });
            };

            return {
                activeFilters,
                hrs: computed(() => store.getters.getHrs),
                take: [150, 200, 300, 500],
                profile: computed(() => store.getters.getProfile),
                statuses: computed(() => store.getters.getStatuses),
                contacted: "",
               /* contacted: computed(() => {
                    moment.locale('en-ca');
                    let tenAgoDate = moment().subtract(10, 'hours').format('L');
                    let twentyForAgoDate = moment().subtract(24, 'hours').format('L');
                    let fortyEightAgoDate = moment().subtract(48, 'hours').format('L');

                    moment.locale('fr');
                    let tenAgoTime = moment().subtract(10, 'hours').format('LTS');
                    let twentyForAgoTime = moment().subtract(24, 'hours').format('LTS');
                    let fortyEightAgoTime = moment().subtract(48, 'hours').format('LTS');


                    return [
                        {
                            "label": "today",
                            "value": tenAgoDate + " " + tenAgoTime,
                        },
                        {
                            "label": "yesterday",
                            "value": [
                                {
                                    "timestamp": twentyForAgoDate + " " + twentyForAgoTime,
                                    "filter": "contacted_after",
                                }
                            ]
                        },
                        {
                            "label": "2 days +",
                            "value": fortyEightAgoTime + " " + fortyEightAgoDate
                        },
                    ]
                }),*/
                companies: computed(() => store.getters.getCompanies),
                showCreateEmployeeForm: () => emitter.emit('create-employee-form'),
                showFileUploadForm: () => emitter.emit('file-input-form'),
                handleContacted: (status) => {
                    if(status == "today" ) {
                        setToday()
                        return
                    }

                    if(status == "yesterday" ) {
                        setYesterday()
                        return

                    }

                    if(status == "2 days +" ) {
                        setTwoDays()
                        return
                    }

                    store.commit('employee/setQueryParams', {
                        'params': [
                            {
                                'key': 'contacted_before',
                                'value': ""
                            },
                            {
                                'key': 'contacted_after',
                                'value': ""
                            },
                            {
                                'key': 'contacted_between',
                                'value': ""
                            },
                            {
                                'key': 'status',
                                'value': ""
                            }
                        ]
                    });

                },

                refresh: () => {
                    getApplicants()
                    store.dispatch('manager/setProfile')
                }
            }
        }
    };
</script>
