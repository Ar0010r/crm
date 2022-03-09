<template>
    <ul role="menubar" aria-disabled="false" aria-label="Pagination" v-if="meta.last_page && meta.last_page > 1"
        class="pagination justify-content-center justify-content-sm-end m-0 b-pagination pagination-sm">
        <li role="presentation" aria-hidden="true" class="page-item disabled"
            v-if="meta.last_page > 10 && meta.prev_page_url"
            @click="goToPage(1)"
        >
            <span role="menuitem"
                  aria-label="Go to first page"
                  aria-disabled="true"
                  class="page-link">
                «
            </span>
        </li>
        <li role="presentation" aria-hidden="true" class="page-item disabled"
            v-if="meta.prev_page_url"
            @click="goToPage(meta.current_page -1)"
        >
            <span role="menuitem"
                  aria-label="Go to previous page"
                  aria-disabled="true"
                  class="page-link">
                ‹
            </span>
        </li>
        <!----><!---->
        <li role="presentation" class="page-item"
            v-for="page in getPages(meta.current_page, meta.last_page)"
            :class="{ active: page === meta.current_page}"
            @click="goToPage(page)"
        >
            <button role="menuitemradio" type="button" aria-label="Go to page 1" aria-checked="true" aria-posinset="1"
                    aria-setsize="5" tabindex="0" class="page-link">
                {{ page }}
            </button>
        </li>
        <!----><!---->
        <li role="presentation" class="page-item"
            v-if="meta.next_page_url"
            @click="goToPage(meta.current_page + 1)"
        >
            <button role="menuitem" type="button" tabindex="-1" aria-label="Go to next page" class="page-link">›
            </button>
        </li>
        <li role="presentation" class="page-item"
            v-if="meta.last_page > 10 && meta.next_page_url"
            @click="goToPage(meta.last_page)"
        >
            <button role="menuitem" type="button" tabindex="-1" aria-label="Go to last page" class="page-link">»
            </button>
        </li>
    </ul>
</template>

<script>
import {useStore} from 'vuex';
import {inject, watch, computed} from 'vue'

export default {

    setup(props) {
        const store = useStore();

        watch(() => props.meta, (first, second) => {
            getPages();
            if (props.meta.current_page > props.meta.last_page) {
                goToPage(props.meta.last_page)
            }
        });

        async function goToPage(page) {
            let filters = store.getters[props.getter]
            console.log('props.getter', props.getter);
            console.log('props.getter filters', filters);
            let queryParams = {};
            Object.keys(filters).map(function (key) {
                if (filters[key]) {
                    return  queryParams[key] = filters[key];
                }
            })
            queryParams.page = page;
            await store.dispatch(props.dispatch, queryParams);
        }

        function getPages(current, last) {
            const show = 10;
            let pages = [];
            last = parseInt(last);
            current = parseInt(current);

            let start = current - show / 2,
                end = current + show / 2;

            if (end > last) {
                start -= (end - last);
                end = last;
            }
            if (start <= 0) {
                end += ((start - 1) * (-1));
                start = 1;
            }

            end = end > last ? last : end;

           // for (let i = start; i < end; i++) {
            for (let i = start; i <= end; i++) {
                pages.push(i)
            }

            return pages
        }

        return {
            goToPage, getPages
        }

    },
    props: {
        meta: Object,
        getter: String,
        dispatch: String,
    },
};
</script>
