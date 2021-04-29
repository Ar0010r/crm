<template>
    <div class="d-flex justify-content-between" v-if="data.from !== data.last_page && data.last_page !== 1">
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
        <i>showing {{data.from}} to {{data.to}} of {{data.total}} records</i>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {inject, watch} from 'vue'

    export default {

        setup(props) {
            const container = inject('container');
            const store = useStore();

            watch(() => props.data, (first, second) => {
                if(props.data.current_page > props.data.last_page) {
                    goToPage(props.data.last_page)
                }
            });

            async function goToPage(page) {
                let employees = await container.EmployeeService.getEmployees({'page': page});

                store.commit('employee/setEmployees', employees.employees);
                store.commit('employee/setPagination', employees.pagination);
            }

            return {goToPage}

        },
        props: {data: Object},
    };
</script>
