<template>
    <!--    <div class="d-flex justify-content-between" v-if="data.from !== data.last_page && data.last_page !== 1">-->
    <div class="d-flex justify-content-between">
        <nav>
            <ul class="pagination">
                <li class="page-item"
                    v-if="data.prev_page_url"
                    @click="goToPage(data.current_page -1)"
                >
                    <a class="page-link" href="javascript:void(0)">«</a>
                </li>

                <li class="page-item"
                    v-for="page in getPages(data.current_page, data.last_page)"
                    :class="{ active: page === data.current_page}"
                    @click="goToPage(page)"
                >

                    <a class="page-link" href="javascript:void(0)">{{ page }}</a>
                </li>

                <!--                <li class="page-item"
                                    v-for="i=1 in data.last_page"
                                    :class="{ active: i === data.current_page}"
                                    @click="goToPage(i)"
                                >

                                    <a class="page-link" href="javascript:void(0)">{{i}}</a>
                                </li>-->

                <li class="page-item"
                    v-if="data.next_page_url"
                    @click="goToPage(data.current_page + 1)"
                >
                    <a class="page-link" href="javascript:void(0)">»</a>
                </li>
            </ul>
        </nav>
        <i>showing {{ data.from }} to {{ data.to }} of {{ data.total }} records</i>
    </div>
</template>

<script>
import {useStore} from 'vuex';
import {inject, watch, computed} from 'vue'

export default {

    setup(props) {
        const container = inject('container');
        const store = useStore();
        let activeFilters = computed(() => store.getters.getEmployeeQueryParams);

        watch(() => props.data, (first, second) => {
            getPages();
            if (props.data.current_page > props.data.last_page) {
                goToPage(props.data.last_page)
            }
        });

        async function goToPage(page) {
            console.log(props.data)
            let employees = await container.EmployeeService.getEmployees({
                'page': page,
                'hr_id': activeFilters.value.hr_id,
                'status': activeFilters.value.status,
                'company_id': activeFilters.value.company_id,
                'take': activeFilters.value.take,
            });

            store.commit('employee/setEmployees', employees.employees);
            store.commit('employee/setPagination', employees.pagination);
        }

        function getPages(current, last) {
            const show = 10;
            let pages = [];
            last = parseInt(last);
            current = parseInt(current);

            let start = current - show/2,
                end = current + show/2;

            if (end > last) {
                start -= (end - last);
                end = last;
            }
            if (start <= 0) {
                end += ((start - 1) * (-1));
                start = 1;
            }

            end = end > last ? last : end;

            for (let i = start; i < end; i++) {
                pages.push(i)
            }

            return pages
        }

        return {
            goToPage, getPages
        }

    },
    props: {data: Object},
};
</script>
