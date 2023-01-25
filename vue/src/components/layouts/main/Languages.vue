<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    data() {
        return {
            items: App.languages.active,
            main: App.languages.active[App.locale],
        };
    },
    created() {
        let href = this.$route.href,
            routeLocale = this.$route.params.locale;

        if (routeLocale !== undefined) {
            href = href.replace('/' + routeLocale, '');
        }

        for (let key in this.items) {
            this.items[key]['url'] = '/' + key + href;
        }
    },
};
</script>

<template>
    <div class="dropdown d-none d-lg-inline-block ms-2">
        <button
            type="button"
            class="btn header-item waves-effect"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <img class="me-2" :src="main.image.widen_25.webp" alt="Header Language" />
            {{ main.name }}
            <span class="mdi mdi-chevron-down"></span>
        </button>

        <div class="dropdown-menu dropdown-menu-end">
            <template v-for="(item, key) in items">
                <a :href="item.url" :class="'dropdown-item notify-item ' + (key === App.locale ? 'active' : '')">
                    <img :src="item.image.widen_25.webp" alt="user-image" class="me-2" />
                    <span class="align-middle"> {{ item.name }} </span>
                </a>
            </template>
        </div>
    </div>
</template>
