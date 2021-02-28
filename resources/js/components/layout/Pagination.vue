<template>
    <div class="d-flex justify-content-between" v-if="data.from !== data.last_page">
        <nav>
            <ul class="pagination">
                <li class="page-item"
                    v-if="data.prev_page_url"
                    @click="goToPage(data.current_page -1)"
                >
                    <a class="page-link" href="javascript:void(0)">«</a>
                </li>

                <li class="page-item"
                    v-for="i=1 in data.last_page"
                    :class="{ active: i === data.current_page}"
                    @click="goToPage(i)"
                >
                    <a class="page-link" href="javascript:void(0)">{{i}}</a>
                </li>

                <li class="page-item"
                    v-if="data.next_page_url"
                    @click="goToPage(data.current_page + 1)"
                >
                    <a class="page-link" href="javascript:void(0)">»</a>
                </li>
            </ul>
        </nav>
        <i>showing {{data.from}} to {{data.last_page}} of {{data.total}} records</i>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {inject} from 'vue'

    export default {
        setup() {
            const container = inject('container');
            const store = useStore();

            async function goToPage(page) {
                store.commit('employee/setQueryParam', {'key': 'page', 'value': page});

                let params = store.getters.getEmployeeQueryParams;

                let employees = await container.EmployeeService.getEmployees({
                    'filter[company_id]': params.company,
                    'filter[status]': params.status,
                    'page': params.page,
                    'recordsPerPage': params.recordsPerPage
                });

                store.commit('employee/setEmployees', employees.employees);
                store.commit('employee/setPagination', employees.pagination);
            }

            return {goToPage}

        },
        props: {data: Object},
    };
</script>
