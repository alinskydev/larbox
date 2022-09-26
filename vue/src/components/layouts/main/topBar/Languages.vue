<script>
export default {
    data() {
        return {
            items: this.booted.languages.active,
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
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-globe"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right p-0">
            <template v-for="(item, key, index) in items">
                <a :href="item.url" :class="'dropdown-item py-2 ' + (key === booted.locale ? 'active' : '')">
                    <img :src="item.image?.w_30" class="mr-2" />
                    {{ item.name }}
                </a>
            </template>
        </div>
    </li>
</template>
