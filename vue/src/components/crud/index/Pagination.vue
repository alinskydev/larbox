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
            items: [],
        };
    },
    created() {
        let qty = 3,
            from = this.meta.current_page > qty ? this.meta.current_page - qty : 1,
            to = this.meta.last_page - qty > this.meta.current_page ? this.meta.current_page + qty : this.meta.last_page;

        for (from; from <= to; from++) {
            this.items.push(from);
        }
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
                <a @click="go(1)" href="#" class="page-link">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>

            <li :class="'page-item ' + (meta.current_page === 1 ? 'disabled' : '')">
                <a @click="go(meta.current_page - 1)" href="#" class="page-link">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>

            <li v-for="item in items" :class="'page-item ' + (item === meta.current_page ? 'active' : '')">
                <a @click="go(item)" href="#" class="page-link">{{ item }}</a>
            </li>

            <li :class="'page-item ' + (meta.current_page === meta.last_page ? 'disabled' : '')">
                <a @click="go(meta.current_page + 1)" href="#" class="page-link">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>

            <li :class="'page-item ' + (meta.current_page === meta.last_page ? 'disabled' : '')">
                <a @click="go(meta.last_page)" href="#" class="page-link">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        </ul>
    </div>
</template>
