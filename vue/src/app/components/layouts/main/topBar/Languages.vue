<script setup>
</script>

<script>
export default {
    data() {
        return {
            items: [],
        };
    },
    beforeCreate() {
        this.booted.components.languages = this;
    },
    beforeUpdate() {
        let href = this.$route.href;
        let routeLocale = this.$route.params.locale;

        if (routeLocale !== undefined) {
            href = href.replace('/' + routeLocale, '');
        }

        let languages = this.booted.languages.active;

        for (let key in languages) {
            languages[key]['url'] = '/' + key + href;
        }

        this.items = languages;
    },
    methods: {
        changeLocale(url) {
            this.$router.push(url);
            this.booted.components.app.$data.childKey++;
        },
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
                <a @click="changeLocale(item.url)"
                   href="#"
                   :class="'dropdown-item py-2 ' + (key === booted.locale ? 'active' : '')">

                    <img :src="item.image?.w_30" class="mr-2">
                    {{ item.name }}
                </a>
            </template>
        </div>
    </li>
</template>