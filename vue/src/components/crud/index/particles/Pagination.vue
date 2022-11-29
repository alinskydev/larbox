<script>
export default {
    props: {
        meta: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            items: this.meta.links.slice(1, this.meta.links.length - 1),
        };
    },
    methods: {
        go(page) {
            this.$router
                .push({
                    path: this.$route.path,
                    query: {
                        ...this.$route.query,
                        ...{ page: page },
                    },
                })
                .then(() => {
                    this.$parent.$parent.$data.dataKey++;
                });
        },
    },
};
</script>

<template>
    <div class="d-flex align-items-center justify-content-between">
        <div class="dataTables_info" role="status" aria-live="polite">
            {{ __('Показано с :from по :to записи из :total', meta) }}
        </div>

        <ul v-if="items.length > 1" class="pagination m-0">
            <li :class="'page-item ' + (meta.current_page === 1 ? 'disabled' : '')">
                <a @click="go(meta.current_page - 1)" href="#" class="page-link">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>

            <li v-for="item in items" :class="'page-item ' + (item.active ? 'active' : '')">
                <a v-if="item.url" @click="go(item.label)" href="#" class="page-link" v-html="item.label"></a>
                <div v-else class="page-link bg-transparent border-0" v-html="item.label"></div>
            </li>

            <li :class="'page-item ' + (meta.current_page === meta.last_page ? 'disabled' : '')">
                <a @click="go(meta.current_page + 1)" href="#" class="page-link">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</template>
